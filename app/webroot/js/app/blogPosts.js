
var BlogPosts = React.createClass({
    render: function() {
        var posts = this.props.data.Posts.map(function (post) {
            return (
                <Post data={post} />
            );
        });
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
                    <Link to="blogView" params={{blogId: this.props.data.id}} >
                        {this.props.data.title}
                    </Link>
                </h2>
                <p>{this.props.data.date}</p>
                <p>{this.props.data.content}</p>
            </div>
        );
    }
});

var BlogView = React.createClass({
    render: function() {
        return (
           <div />
        );
    }
});
