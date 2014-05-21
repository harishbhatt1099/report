<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_auth {

    /**
     * Constructor
     */
    public function __construct() {
        $this->CI = & get_instance();
//        $this->load->database();
    }

    /**
     * Log In Action
     *
     * This function does a couple of things.
     * First, we query to see if the username exists in the database
     * If it does, we grab the salt from that query.  Then concatenate
     * the salt with the posted password, sha1() the whole things together.
     * so if all goes well, we're golden.
     *
     * @param   string      username
     * @param   string      password
     * @return  mixed       FALSE on failure, user_id on success
     */
    public function log_in($username, $password) {
        $qry = $this->CI->db->select('user_id, user_email, user_password, user_act_key, user_group')
                ->where('user_email', $username)
//                                                ->where('user_status', 'approved')
                ->get('users');
        // No results, we're done.

        if (!empty($qry) && $qry->num_rows() !== 1) {
            return FALSE;
        }

        if (!empty($qry) && sha1($password . $qry->row('user_act_key')) == $qry->row('user_password')) {

            $group = $this->CI->db->get_where('groups', array('ID' => $qry->row('user_group')))->row('group_name');
            $data = array(
                'user_id' => $qry->row('user_id'),
                'user_email' => $qry->row('user_email'),
                'user_group' => $group,
            );
            $this->CI->session->set_userdata($data);
//            print_r($this->CI->session->all_userdata());
            return $qry->row('user_id');
        }
        return FALSE;
    }

    /**
     * Log Out Action
     *
     * This function unset all the data from
     * the session which are set during the
     * Log in process.
     *
     */
    public function log_out() {
        $this->CI->session->unset_userdata(array('user_id' => '', 'user_email' => ''));
        $this->CI->session->sess_destroy();
    }

    /**
     * Create new user
     *
     * This function creates a new user.  It does check to make
     * sure a user with the same email or username does not already
     * exists.  Return FALSE if the user exists, return the new users
     * id if the user exists.
     *
     * @todo    consider just using callbacks in the controller
     * to test for a unique username or email
     *
     * @param   string      email
     * @param   string      password
     * @return  mixed       user_id
     */
    public function create_user($email, $password, $fname, $lname, $group) {
        $qry = $this->CI->db->where('user_email', $email)
                ->get('users');
        if ($qry->num_rows() !== 0)
            return FALSE;

        $salt = $this->_create_salt();

        $data = array(
            'user_email' => $email,
            'user_fullname' => $fname . ' ' . $lname,
            'user_password' => sha1($password . $salt),
            'user_type' => 'user',
//            'user_status' => 'unapproved',
            'user_status' => 'approved',
            'user_rgt_on' => date('Y-m-d H:m:s'),
            'user_act_on' => date('Y-m-d H:m:s'),
            'user_act_key' => $salt,
            //New Field for RTL Project
            'user_group' => $group,
        );

        $this->CI->db->insert('users', $data);

        return $this->CI->db->insert_id();
    }

    /**
     * Create Salt
     *
     * This function will create a salt hash to be used in
     * authentication
     *
     * @return string the salt
     */
    protected function _create_salt() {
        $this->CI->load->helper('string');
        return sha1(random_string('alnum', 32));
    }

    /**
     * Logged in Check
     *
     * This function will check the user is logged in
     * or not.
     *
     * @return 	boolean		true if logged in or false if not
     */
    public function is_logged_in() {
        $uid = $this->CI->session->userdata('user_id');
        if (!empty($uid))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Change Password
     *
     * This function will check the password is already in database
     * or not. If password is exist than it will return false,
     * otherwise this function will change the password.
     *
     * @param	int			user id
     * @param	string		32 bit random string
     * @param	string		old password
     * @param	string		New password
     * @return 	boolean		true if password exist or false if not
     */
    public function change_password($uid, $act_key, $password, $newpassword) {
        $qry = $this->CI->db->select('user_id, user_email, user_password, user_act_key')
                ->where('user_id', $uid)
                ->where('user_act_key', $act_key)
                ->get('users');
        // No results, we're done.
        if ($qry->num_rows() !== 1) {
            return FALSE;
        }

        if (sha1($password . $qry->row('user_act_key')) == $qry->row('user_password')) {
            $salt = $this->_create_salt();

            $data = array(
                'user_password' => sha1($newpassword . $salt),
                'user_act_key' => $salt
            );

            $this->CI->db->update('users', $data, array('user_id' => $uid));

            return TRUE;
        }

        return FALSE;
    }

    public function change_pass_forgot($user_email, $new_pass) {
        $salt = $this->_create_salt();
        $data = array(
            'user_password' => sha1($new_pass . $salt),
            'user_act_key' => $salt
        );
        $q = $this->CI->db->update('users', $data, array('user_email' => $user_email));
        return $this->CI->db->affected_rows();
    }

    public function change_pass_by_admin($user_id, $new_pass) {
        $salt = $this->_create_salt();
        $data = array(
            'user_password' => sha1($new_pass . $salt),
            'user_act_key' => $salt
        );
        $q = $this->CI->db->update('users', $data, array('user_id' => $user_id));
        return $this->CI->db->affected_rows(); //affected_rows();
    }

    /**
     * Forgot Password
     *
     * This function will check the user is already in database
     * or not.
     *
     * @param	string		username
     * @return 	mixed		FALSE on failure, user detail array on success
     */
    public function forgot_password($username) {
        $qry = $this->CI->db->where('user_email', $username)
                ->get('users');

        // No results, we're done.
        if ($qry->num_rows() !== 1) {
            return FALSE;
        }

        return $qry->row_array();
    }

}
