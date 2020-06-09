export function singleton(target, name, descriptor) {
	const instance = Symbol("instance");
	target.getInstance = () => {
		if (!target[instance]) {
			target[instance] = new target();
		}
		return target[instance];
	};
	return target;
}