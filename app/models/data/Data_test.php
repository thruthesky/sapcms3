<?php
class Data_test extends Data {
    public function unitTest() {
        $this->createData();
        $this->uploadFile();
    }

    private function createData() {
        $data = data()->create()
            ->save();
        $this->unit->run( $data->get('id') > 0, TRUE, "creating a data");
        $data->delete();
    }


    private function uploadFile()
    {
        $upload_url = base_url() . 'data/upload';

        $data = array(
            'files[0]'=> get_CURLFileObject('./app/models/data/test-file-upload.png'),
            //'files[1]'=> get_CURLFileObject('./app/models/data/test-file-upload2.png'),
            );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$upload_url);
        curl_setopt($ch, CURLOPT_POST,TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec ($ch);
        if ( ! $result ) echo "ERROR: Data_test.php::uploadFile() : " . curl_error($ch) . "\n";
        curl_close ($ch);
    }
}
