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
			path: 'wp/v2/posts?per_page=4'
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

					<div className="d-flex flex-row flex-wrap">
						{this.state.posts.map(currentPost => {
							return (
								<div key={currentPost.id} className="col-md-6">
									<h3>{currentPost.title.rendered}</h3>
								</div>
							);
						})}
					</div>
				)}
			</div>
		);

	}
}
