<!--main content start-->
<section id="main-content">
    <section class="wrapper">

        

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
                {# grid.render() #}
            </div>
            <div id="reviews" class="tab-pane">
                {{ imports.render() }}
            </div>
        </div>
      </div>
    </section>

</section>
<!--main content end-->

