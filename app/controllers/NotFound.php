<?php

class NotFound
{

    // This function is called when the requested page is not found.
    public function index($params = null)
    {
        // Set the default data for the view.

        // Redirect to the home page if the requested page is not found.
        if ($params == null) {
            header('Location:' . Routes::base('beranda'));
        }

        // Set the data for the view.
        foreach ($params as $key => $value) {
            $data['message'][$key] = $value;
        }

        $message = "";

        // Check if there is a message in the data.
        if (isset($data['message'])) {
            $message = $data['message'][0];
        }

        // Set the data for the view.
        $data['message'] = $message;

        // Render the view.
        App::view("error/index", $data);

    }
}
