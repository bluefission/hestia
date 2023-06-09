// https://dev.to/emnudge/from-scratch-reactive-values-c9h
// initially undefined. We can set it to null instead.
let computeFunc;

export function computed(func) {
  const reactor = new Reactor(null);

  // move the local variable assignment into the subcribed function
  const fn = () => {
    const prevVal = computeFunc;
    computeFunc = fn;

    reactor.value = func();

    computeFunc = prevVal;
  };

  fn();

  return reactor;
}

export class Reactor {
  constructor(value) {
    this._val = value;
    this._subscribers = new Set();
  }

  get value() {
    // If it exists, we add it to the subscribers.
    // Do not call it, unlike a regular subscriber.
    if (computeFunc) this._subscribers.add(computeFunc);

    return this._val;
  }

  set value(newVal) {
    this._val = newVal;
    for (const subscribeFunc of this._subscribers) {
      subscribeFunc(newVal);
    }
  }

  subscribe(func) {
    this._subscribers.add(func);
    func(this._val);
  }
}
