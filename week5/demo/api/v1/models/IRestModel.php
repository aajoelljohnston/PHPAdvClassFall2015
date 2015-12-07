<?php

/**
 *
 * @author GFORTI
 */
interface IRestModel {
    //put your code here
    function getAll();
    function get($id);
    function post ($getData);
    function put($getData,$id);
    function delete ($id);
}
