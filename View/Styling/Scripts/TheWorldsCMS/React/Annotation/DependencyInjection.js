/**
 * @returns {Function}
 * @param object: holds all Services I want to inject into my Component
 */
export function InjectServices(object) {
	let objectKeys = Object.keys(object);
	return function(target, name, descriptor) {
		objectKeys.forEach((serviceName) => {
			Object.defineProperty(target.prototype, serviceName, {
				value: object[serviceName],
				writable: false
			});
		});
	};
}