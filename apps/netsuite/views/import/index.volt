<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        {# grid.render() #}

    </section>

    <section class="panel">
		<header class="panel-heading tab-bg-dark-navy-blue">
		  <ul class="nav nav-tabs ">
		      <li class="active">
		          <a data-toggle="tab" href="#description">
		              Description
		          </a>
		      </li>
		      <li>
		          <a data-toggle="tab" href="#reviews">
		              Reviews
		          </a>
		      </li>

		  </ul>
		</header>
		<div class="panel-body">
		  <div class="tab-content tasi-tab">
		      <div id="description" class="tab-pane active">
		          {{ grid.render() }}
		      </div>
		      <div id="reviews" class="tab-pane">
		          <article class="media">
		              <a class="pull-left thumb p-thumb">
		                  <img src="img/avatar-mini.jpg">
		              </a>
		              <div class="media-body">
		                  <a href="#" class="cmt-head">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
		                  <p> <i class="icon-time"></i> 1 hours ago</p>
		              </div>
		          </article>
		          <article class="media">
		              <a class="pull-left thumb p-thumb">
		                  <img src="img/avatar-mini2.jpg">
		              </a>
		              <div class="media-body">
		                  <a href="#" class="cmt-head">Nulla vel metus scelerisque ante sollicitudin commodo</a>
		                  <p> <i class="icon-time"></i> 23 mins ago</p>
		              </div>
		          </article>
		          {{ imports.render() }}
		      </div>
		  </div>
		</div>
	</section>


</section>
<!--main content end-->