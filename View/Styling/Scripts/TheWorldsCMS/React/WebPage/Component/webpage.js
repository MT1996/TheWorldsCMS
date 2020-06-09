import React, { Component } from "react";
import { Helmet } from "react-helmet";
import { InjectServices } from "../../Annotation/DependencyInjection";
import { ApiResult } from "../Model/ApiResult";
import { CommunicationService } from "../Service/communicationService";

@InjectServices({
	communicationService: CommunicationService.getInstance()
})
export class WebPage extends Component {

	/** @type ApiResult */
	results;

	constructor(props) {
		super(props);
		this.state = {
			contentIsLoaded: false
		};
		/** @type CommunicationService */
		this.communicationService.getInformationAboutCMS().then((results) => {
			this.results = Object.assign(new ApiResult(), results);
		}).catch((error) => {
			throw new Error(error);
		}).finally(() => {
			this.setState({contentIsLoaded : true});
		});
	}

	render() {
		if (this.state.contentIsLoaded) {
			return (
				<div className={"container-fluid"}>
					<Helmet>
						<title>TheWorldsCMS - Backend</title>
						<meta name={"description"} content={"Beschreibung der Seite hier einfügen"} />
						<meta name={"keywords"} content={"SEO,React,React-Helmet"} />
					</Helmet>
					<div className={"row"}>
						<div className={"col-12"}>
							{this.results.data}
						</div>
					</div>
				</div>
			)
		} else {
			return (
				<div className={"container-fluid"}>
					<div className={"row"}>
						<p>Content is still loading</p>
					</div>
				</div>
			)
		}

	}

}