<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<?php $cat = DB::table('categories')->where('category_status','=',"1")->get(); ?>
							 @foreach($cat as $category)  
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{ $category->category_name }}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{ $category->category_name}}
											<?php 
											$cat_name = $category->category_name 
											?>
										</a>
									</h4>
								</div>
								<div id="{{ $category->category_name }}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<?php $subcat = DB::table('subcategories')->where('category_name','=',$cat_name)->where('subcategory_status','=',"1")->get(); ?>
											 @foreach($subcat as $subcat) 
											<li><a href="/products/{{ $category->category_name }}/{{ $subcat->subcategory_name }}">{{ $subcat->subcategory_name}}</a></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					</div>
				</div>