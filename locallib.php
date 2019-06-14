<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file contains the definition for the library class for kohareview submission plugin.
 * Based on the core Moodle onlinetext assignment activity type, Copyright 2012 Netspot
 *
 * This class provides all the functionality for the new assign module.
 *
 * @package assignsubmission_kohareview
 * @copyright 2019 Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * library class for kohareview submission plugin extending submission plugin base class
 *
 * @package assignsubmission_kohareview
 * @copyright 2019 Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class assign_submission_kohareview extends assign_submission_plugin {

    /**
     * Get the name of the online text submission plugin
     * @return string
     */
    public function get_name() {
        return get_string('kohareview', 'assignsubmission_kohareview');
    }

    /**
     * Remove a submission.
     *
     * @param stdClass $submission The submission
     * @return boolean
     */
    public function remove(stdClass $submission) {
        global $DB;

        return true;
    }

    /**
     * Get the settings for kohareview submission plugin
     *
     * @param MoodleQuickForm $mform The form to add elements to
     * @return void
     */
    public function get_settings(MoodleQuickForm $mform) {

        $options = array('size' => '6');
        $name = get_string('kohaid', 'assignsubmission_kohareview');
        $defaultkohaid = $this->get_config('kohaid') == 0 ? '' : $this->get_config('kohaid');

        // Create a text box that can be enabled/disabled for kohareview word limit.
        $wordlimitgrp = array();
        $mform->addElement('text', 'assignsubmission_kohareview_kohaid', $name, $options);

        $mform->addHelpButton('assignsubmission_kohareview_kohaid',
                              'kohaid',
                              'assignsubmission_kohareview');

        $mform->hideIf('assignsubmission_kohareview_kohaid',
                       'assignsubmission_kohareview_enabled',
                       'notchecked');
        $mform->disabledIf ('assignsubmission_kohareview_enabled',
            'assignsubmission_onlinetext_enabled',
            'notchecked');

        $mform->setType('assignsubmission_kohareview_kohaid', PARAM_ALPHANUMEXT);
        $mform->setDefault('assignsubmission_kohareview_kohaid', $defaultkohaid);
    }

    /**
     * Save the settings for kohareview submission plugin
     *
     * @param stdClass $data
     * @return bool
     */
    public function save_settings(stdClass $data) {
        if (empty($data->assignsubmission_kohareview_kohaid)) {
            $kohaid = 0;
        } else {
            $kohaid = $data->assignsubmission_kohareview_kohaid;
        }

        $this->set_config('kohaid', $kohaid);

        return true;
    }

    /**
     * Add form elements for settings
     *
     * @param mixed $submission can be null
     * @param MoodleQuickForm $mform
     * @param stdClass $data
     * @return true if elements were added to the form
     */
    public function get_form_elements($submission, MoodleQuickForm $mform, stdClass $data) {
        // We don't add any "extra editing options - this relies on the online text submission.

        return true;
    }

    /**
     * Save data to the database and trigger plagiarism plugin,
     * if enabled, to scan the uploaded content via events trigger
     *
     * @param stdClass $submission
     * @param stdClass $data
     * @return bool
     */
    public function save(stdClass $submission, stdClass $data) {
        return true;
    }

    /**
     * Return a list of the text fields that can be imported/exported by this plugin
     *
     * @return array An array of field names and descriptions. (name=>description, ...)
     */
    public function get_editor_fields() {
        return array();
    }


     /**
      * Display onlinetext word count in the submission status table
      *
      * @param stdClass $submission
      * @param bool $showviewlink - If the summary has been truncated set this to true
      * @return string
      */
    public function view_summary(stdClass $submission, & $showviewlink) {
        global $CFG;

        return '';
    }

    /**
     * Display the saved text content from the editor in the view table
     *
     * @param stdClass $submission
     * @return string
     */
    public function view(stdClass $submission) {
        $result = 'KOHAVIEWTEXT';

        return $result;
    }

    /**
     * The assignment has been deleted - cleanup
     *
     * @return bool
     */
    public function delete_instance() {
        global $DB;

        return true;
    }

    /**
     * Copy the student's submission from a previous submission. Used when a student opts to base their resubmission
     * on the last submission.
     * @param stdClass $sourcesubmission
     * @param stdClass $destsubmission
     */
    public function copy_submission(stdClass $sourcesubmission, stdClass $destsubmission) {

        return true;
    }

    /**
     * Return a description of external params suitable for uploading an onlinetext submission from a webservice.
     *
     * @return external_description|null
     */
    public function get_external_parameters() {
        return null;
    }

    /**
     * Return the plugin configs for external functions.
     *
     * @return array the list of settings
     * @since Moodle 3.2
     */
    public function get_config_for_external() {
        return (array) $this->get_config();
    }

    /**
     * Display information about the book selected by the teacher in the view assignment page.
     *
     * @return string
     */
    public function view_header() {
        return '<p>SHOW LINK TO BOOK THINGY!!</p>';
    }
}


