<?php

function create_object_from_another_object_properties($properties_to_get, $object) {

	$new_object = [];

	foreach ($properties_to_get as $property_to_get) {

		$new_object[$property_to_get] = $object->$property_to_get;

	}

	return $new_object;

}