<?php 

class JsonResponse {

    private $success = false;
    private $message = array();
    private $data = null;

    public function __construct($success, $message, $data) {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    public function jsonSerialize() {
		return json_encode(get_object_vars($this));
	}
}

?>