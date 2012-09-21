<?php

namespace Main\Controller;

use Zend\Json\Json;
use Album\Model\AlbumTable;
use Zend\Http\Request;
use Main\Http\Restful;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Json\Decoder;
//use Zend\InputFilter\InputFilter;
//use Zend\InputFilter\Input;
//use Zend\Validator;
use Main\Model\ValidatorRestAlbum;


/**
 * Core of restful web service
 *
 */
class InfoController extends AbstractRestfulController
{
    /**
     * Return list of resources
     *
     * @return array
     */

    public function getList()
    {
        $t= $this->getServiceLocator()->get('albumTable');
        $list = $t->fetchAll();
        foreach ($list as $v){
            $c[] = $v;
        }
        return $c;
        //die (var_dump($c));
    }

    /**
     * Return single resource
     *
     * @param mixed $id
     * @return mixed
     */
    public function get($id) {
        $t= $this->getServiceLocator()->get('albumTable');
        $u = $t->getAlbum($id);
        return $u;
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete($id) {
        $d = $this->getServiceLocator()->get('albumTable');
        $d->deleteAlbum($id);
        return 'fatto';
    }
    public function update($id, $data) {

        $json = "{ \"artist\":\"dgegseg\", \"title\":\"dgdsrgsd\" }";
        $array = \Zend\Json\Decoder::decode($json);
        $v = $this->getServiceLocator()->get('validatorRestAlbum');
        $v->validatorAlbum($array);
        if ($array){
            $i = $this->getServiceLocator()->get('albumTable');
            $i->updateRestfulAlbum($array, $id);
            return $array;
        } else {
            echo "is not valid ciao\n";
            foreach ($inputFilter->getInvalidInput() as $error) {
                return (print_r ($error->getMessages()));
            }
        }
    }

    /**
     * Create a record into db album
     *
     * @param  json string
     * @return mixed
     */

    public function create($data = null) {
        $data = "{ \"artist\":\"serddfhdfdhn\", \"title\":\"enruy7u\" }";
        $array = \Zend\Json\Decoder::decode($data);
        $v = $this->getServiceLocator()->get('validatorRestAlbum');
        $v->validatorAlbum($array);
        if ($array){
            $i = $this->getServiceLocator()->get('albumTable');
            $i->saveRestfulAlbum($array);
            return $array;
        } else {
            echo "is not valid ciao\n";
            foreach ($inputFilter->getInvalidInput() as $error) {
                return (print_r ($error->getMessages()));
            }
        }
    }
}
