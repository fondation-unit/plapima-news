import {Spinner} from '@wordpress/components';
import {Component} from '@wordpress/element';
import { useState } from "react";

export default class PlapimaNews extends Component {
	constructor(props) {
		super(props);
		this.state = {
			formations: [],
			num: 1,
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
		const [num, setNum] = useState(1);
		return (
			<div>
				{this.state.loading ? (
					<Spinner/>
				) : (

					<div className="d-flex flex-row flex-wrap">
						{this.state.posts.map(currentPost => {
							console.log(currentPost)
							console.log(this.state.num)
							return (
								<div key={currentPost.id} className='col-md-6'>
									test {this.state.num}
								</div>
							);
							{
								setNum(this.state.num+1);
							}
						})}
					</div>
				)}
			</div>
		);
	}
}
