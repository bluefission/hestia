import { computed, Reactor } from "./reactor.js";

export class El {
  constructor(el) {
    this._el = el;
  }

  append(el) {
    if (el instanceof El) {
      this._el.appendChild(el._el);
    } else if (typeof el === "string") {
      this._el.appendChild(new Text(el));
    } else {
      this._el.appendChild(el);
    }

    return this;
  }

  on(eventName, func) {
    this._el.addEventListener(eventName, func);
  }

  bind(name, funcOrReactor, options = {}) {
    // grab reactor from function, if it isn't a reactor
    const reactor =
      funcOrReactor instanceof Reactor
        ? funcOrReactor
        : computed(funcOrReactor);

    // if editing value, apply 2-way  binding
    if (name === "value") {
      this.on("input", (e) => {
        const val = options.mutator
          ? options.mutator(e.target.value)
          : e.target.value;
        if (options.rejectOn && options.rejectOn(val)) return;
        reactor.value = val;
      });

      // change property when reactive value changes
      reactor.subscribe((val) => (this._el[name] = val));
    } else if (name === "textContent") {
      reactor.subscribe((val) => (this._el[name] = val));
    } else {
      // if not textContent or value, it's probably an attribute
      reactor.subscribe((val) => this._el.setAttribute(name, val));
    }

    // allow method to be chained
    return this;
  }
}

export function get(selector) {
  const el = document.querySelector(selector);
  return new El(el);
}

export function create(selector) {
  const el = document.createElement(selector);
  return new El(el);
}
