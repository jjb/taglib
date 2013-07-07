<?php
/*
	This is a general xhtml tag generation library.
*/

// xhtml 1.0 transitional
$tags = array('a', 'abbr', 'acronym', 'address', 'applet', 'area', 'b', 'bdo', 'big', 'blockquote', 'body', 'button', 'caption', 'cite', 'code', 'colgroup', 'dd', 'del', 'dfn', 'div', 'dl', 'DOCTYPE', 'dt', 'em', 'fieldset', 'form', 'frameset', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'html', 'i', 'iframe', 'ins', 'kbd', 'label', 'legend', 'li', 'link', 'map', 'noframes', 'noscript', 'object', 'ol', 'optgroup', 'option', 'p', 'pre', 'q', 'samp', 'script', 'select', 'small', 'span', 'strong', 'style', 'sub', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'title', 'tr', 'tt', 'ul', 'var');

$tags_sc = array('base', 'br', 'col', 'frame', 'hr', 'input', 'img', 'meta', 'param');

function construct_attributes($attributes){
	$attributestring = '';
	if (false !== $attributes){
		foreach($attributes as $name => $value){
			$attributestring .= " $name=\"$value\"";
		}
	}
	return $attributestring;
}

function construct_tag($tag, $attributestring, $sc, $body=false){
	$tagstring = '<' . $tag . $attributestring;
	$tagstring.= $sc ? ' />'	: '>' . $body . '</'.$tag.'>';
	return $tagstring;
}

function tag($tag, $body, $attributes=false){
	return construct_tag($tag, construct_attributes($attributes), false, $body);
}

function tag_sc($tag, $attributes=false){
	return construct_tag($tag, construct_attributes($attributes), true);
}

function create_tag_function($tag, $sc){
	if (!$sc)
		return "
			function _$tag(){ //attributes, body
				if (2==func_num_args()){ " . '
					$body = func_get_arg(1);
					$attributes = func_get_arg(0); ' . " 
					return tag('$tag', " .'$body, $attributes'. ");
				}
				else{ " . '
					$body = func_get_arg(0); ' . "
					return tag('$tag', " .'$body, false'. ");
				}
			}
		";
	else
		return "
			function _$tag(){ //attributes, body
				if (1==func_num_args()){ " . '
					$attributes = func_get_arg(0); ' . "
					return tag_sc('$tag', " .'$attributes'. ");
				}
				else{
					return tag_sc('$tag', " .'false'. ");
				}
			}
		";
}

$code = '';

foreach($tags as $tag){
	$code .= create_tag_function($tag, false);
}

foreach($tags_sc as $tag){
	$code .= create_tag_function($tag, true);
}

eval($code);

function e($string){
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

?>
