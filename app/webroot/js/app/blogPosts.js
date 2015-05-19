var BlogPosts = React.createClass({
	getInitialState: function() {
		if(this.props.data != null){
			return {data: this.props.data};
		}
		else{
			return {data: null};
		}
	},
	componentDidMount: function() {
		if(this.state.data == null){
			$.ajax({
				url: '/blogPosts/index',
				dataType: 'json',
				cache: false,
				success: function(response) {
					this.setState({data: response});
				}.bind(this),
				error: function(xhr, status, err) {
					console.error(status, err.toString());
				}.bind(this)
			});
		}
	},
    render: function() {
	    var data;
	    if(this.state.data != null){
		    data = this.state.data;
	    }

	    if(data != null && data.BlogPosts != null){
		    var posts = data.BlogPosts.map(function (post) {
			    return (
				    <Post data={post} />
			    );
		    });
	    }

        return (
            <div className="blog-posts">
                {posts}
            </div>
        );
    }
});

var Post = React.createClass({
    render: function(){
        return (
            <div className="post">
                <h2>
                    <Link to="blogView" params={{blogId: this.props.data.BlogPost.id}} >
                        {this.props.data.BlogPost.title}
                    </Link>
                </h2>
                <p>{this.props.data.BlogPost.date}</p>
                <p>{this.props.data.BlogPost.content}</p>
            </div>
        );
    }
});

var BlogView = React.createClass({
	getInitialState: function() {
		if(this.props.data != null){
			return {data: this.props.data};
		}
		else{
			return {data: null};
		}
	},
	componentDidMount: function() {
		if(this.state.data == null){
			$.ajax({
				url: '/blogPosts/view/'+this.props.params.blogId,
				dataType: 'json',
				cache: false,
				success: function(response) {
					this.setState({data: response});
				}.bind(this),
				error: function(xhr, status, err) {
					console.error(status, err.toString());
				}.bind(this)
			});
		}
	},
    render: function() {
	    var data;
	    if(this.state.data != null){
		    data = this.state.data;
	    }

	    if(data != null){
		    return (
			    <div className="post">
				    <h2>
					    {data.BlogPost.title}
				    </h2>
				    <p>{data.BlogPost.date}</p>
				    <p>{data.BlogPost.content}</p>
			    </div>
		    );
	    }
	    else{
		    return (<div/>);
	    }
    }
});
