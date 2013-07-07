This is a library I wrote years ago for a project when I worked at
[Digital Pulp](http://digitalpulp.com). It never got reused in another project
there or elsewhere, and I figured I'd throw it up here in case anyone finds it
useful, interesting, or amusing.

It is simply a collection of functions which generate html tags, so that
html pages can be composed in php, very similar in style and spirit to
[haml](http://haml.info).

## example

```php
function register_page($user){
  return
  _h2('Welcome to ACME hamster shavers, makers of the best hamster shavers
       in the world!') .

  _p('Use the form below to sign up for our email list to hear about our great
      products!') .

  _form(array('method'=>'post', 'action'=>'signup.php', 'style'=>'margin-bottom: 1em;'),
    _input(array('type'=>'hidden', 'name'=>'hash', 'id'=>'hash',
                 'value'=>$user->getHash())) .

    _input(array('type'=>'hidden', 'name'=>'id', 'id'=>'id', 'value'=>$user->getId())) .

    _label(array('for'=>'email'), 'Your E-Mail Address') . ' ' .

    _input(array('type'=>'text', 'name'=>'email', 'id'=>'email',
                 'class'=>'TextInput')) .

    _input(array('type'=>'submit', 'name'=>'submit', 'id'=>'button_continue',
                'class' => 'Button', 'value'=>'Submit'))
  )
  ;
}
```
