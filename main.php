<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Elastic\Elasticsearch\ClientBuilder;

class Search extends CI_Controller {
    private $client;

	function __construct()
	{
		parent::__construct();		
        // Elasticsearch 클라이언트 생성
        $this->client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
	}

    public function index() {
        $this->load->view('search');
    }
    
    public function crowling() {
        $sql = "SELECT SEQ_NUM,USER_CODE FROM iotc_member";
        $query = $this->db->query($sql);
        $users = $query->result();

        foreach ($users as $user) {
            $params = [
                'index' => 'primary',
                'id' => $user->SEQ_NUM,
                'body' => [
                    'SEQ_NUM' => $user->SEQ_NUM,
                    'USER_CODE' => $user->USER_CODE
                ]
            ];
            $this->client->index($params);
        }
    }

    public function result() {
        $search = $this->input->post('search');
        $params = [
            'index' => 'primary',
            'body' => [
                'query' => [
                    'match' => [
                        'USER_CODE' =>[
                            'query' => $search,
                            'fuzziness' => 'AUTO',
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $data['hits'] = $response['hits']['hits'];
        print_r($data); 
        exit;
        $this->load->view('result', $data);
    }
}
