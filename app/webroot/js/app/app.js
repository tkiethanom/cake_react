//var Router = require('react-router'); // or var Router = ReactRouter; in browsers
var Router = ReactRouter;

var DefaultRoute = Router.DefaultRoute;
var Link = Router.Link;
var State = Router.State;
var Route = Router.Route;
var RouteHandler = Router.RouteHandler;

var App = React.createClass({
    render: function () {
        return (
            <div>
                <Navigation />
                {/*<BlogPosts data={this.props.data.Posts}/>*/}

                {/* this is the important part */}
                <RouteHandler data={this.props.data} />
            </div>
        );
    }
});

var Navigation = React.createClass({
    render: function() {
        return (
            <header>
                <nav className="navbar navbar-default">
                    <ul className="nav navbar-nav">
                        <li ><Link to="app">Home</Link></li>
                        <li ><Link to="blog">Blog</Link></li>
                    </ul>
                </nav>
            </header>
        );
    }
});


var Home = React.createClass({
    render: function() {
        return (
            <div>
                <div>Home</div>
            </div>
        );
    }
});

var routes = (
    <Route name="app" path="/" handler={App}>
	    <DefaultRoute handler={Home}/>
	    <Route name="blog" path="/blog" handler={BlogPosts} />
        <Route name="blogView" path="/blog/:blogId" handler={BlogView} />
    </Route>
);

Router.run(routes, Router.HistoryLocation, function (Root) {
    //React.render(<Handler data={data}/>, );
    React.render(<Root data={data} />, $('#content-container')[0]);
});

$(document).ready(function(){
	$(document).on('click','a',function(){
		data = null;
	});

	toggleHeaderActive();
	$(document).on('click','header .nav a',function(){
		$('header .nav li.active').removeClass('active');
		$(this).parent('li').addClass('active');
	});

});


function toggleHeaderActive(){
	var url = window.location.pathname;
	$('header .nav li.active').removeClass('active');

	$('header .nav a').each(function(){
		if(url == $(this).attr('href')){
			$(this).parent('li').addClass('active');
		}
	});
}
