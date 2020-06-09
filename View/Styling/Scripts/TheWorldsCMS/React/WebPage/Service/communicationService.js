import { Service } from "../../GeneralPurposeClasses/Service";
import axios from "axios";
import { singleton } from "../../Annotation/designPattern";

@singleton
export class CommunicationService extends Service {

	constructor() {
		super();
	}

	getInformationAboutCMS() {
		return axios.get("api/theworldscms");
	}

}