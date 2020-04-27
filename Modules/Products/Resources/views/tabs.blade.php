<?php 
  //url for the tabs
  $tabs = array(
                array('url' => URL::route('product-list'),
                      'alias' => 'Products'),

                array('url' => URL::route('category-list'),
                      'alias' => 'Category'),

                array('url' => URL::route('sub-category-list'),
                      'alias' => 'Sub-Category'),

                
                               
                );
?>

<h4>
<b>Products Manager</b>
</h4>
<div class="nav-tabs-custom">            
    <ul class="nav nav-tabs">
      @foreach($tabs as $tab)
        <li @if(Request::url() == $tab['url']) class="active" @endif><a href="{{$tab['url']}}">{{$tab['alias']}}</a></li>
      @endforeach
     
    </ul>
</div>

