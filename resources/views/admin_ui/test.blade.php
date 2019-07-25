
@php
	$category_each = DB::table('categories')->select('category_name')->get();

@endphp
@foreach($category_each as $res)

	@php $count_category_each = DB::table('products')->where('category_name','=',$res->category_name)->count(); @endphp

	@if($count_category_each==0)

	@else
	Category Name : {{ $res->category_name}} <br/>
	Total Product Count Under Category : {{ $count_category_each }}<br/>
	@endif
	

	@php $subcategory_each = DB::table('products')->select('subcategory_name')->where('category_name','=',$res->category_name)->distinct()->get(); @endphp

	@foreach($subcategory_each as $res2)

	@php $count_subcategory_each = DB::table('products')->where('subcategory_name','=',$res2->subcategory_name)->count(); @endphp

	Sub Category Name : {{ $res2->subcategory_name}} <br/>
	Total Product Count Under SubCategory : {{ $count_subcategory_each }}<br/>
	@endforeach

@endforeach
<!-- @foreach($resultCat as $element) 
	Category Name : {{$element->category_name}} <br/>
	Total Count Under Category : {{$element->getProducts->count()}}<br/>
	@foreach($element->getProducts as $product) 

			@foreach($resultSubCat as $scat)
				@if($scat->id == $product->subcategory_id)
					Sub Category Name : {{$scat->subcategory_name}}<br/>
					Sub Category Count : {{$scat->getSubcat->count()}}<br/>
					
				@endif

	@endforeach
		
	@endforeach

	<br/>
@endforeach -->