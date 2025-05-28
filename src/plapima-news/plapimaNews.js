import {Spinner} from '@wordpress/components';
import {Component, useState} from '@wordpress/element';

export default class PlapimaNews extends Component {

	constructor(props) {
		super(props);
		this.state = {
			posts: [],
			loading: true
		};
	}

	componentDidMount() {
		this.runApiFetch();
	}

	runApiFetch() {
		wp.apiFetch({
			path: 'wp/v2/posts?_embed&per_page=4'
		}).then(data => {
			this.setState({
				posts: data,
				loading: false
			});
		});
	}

	render() {
		return (
			<div>
				{this.state.loading ? (
					<Spinner/>
				) : (

					<div className="news-list d-flex flex-column">
						{this.state.posts.map(currentPost => {
							console.log(currentPost);
							let src = currentPost._embedded ? currentPost._embedded['wp:featuredmedia'][0].source_url
								: '';
							return (
								<div key={currentPost.id} className="news d-flex flex-row">
									<div className="col-md-4 d-flex align-items-center">
										<div className="image rounded">
											<img src={src} alt="" className="rounded"/>
										</div>
									</div>
									<div className="content ps-4">
										<h3 dangerouslySetInnerHTML={ { __html: currentPost.title.rendered } }></h3>
										<div className="date">
											{currentPost.date}
										</div>
										<p dangerouslySetInnerHTML={ { __html: currentPost.excerpt.rendered } }></p>
									</div>
								</div>
							);
						})}
					</div>
				)}
			</div>
		);

	}
}
