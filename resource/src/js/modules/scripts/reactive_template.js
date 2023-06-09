// "reactive_template.js"
import { El, get, set, assign, create } from "./framework.js";
import { computed, Reactor } from "./reactor.js";
import Template from "./template.js";

class ReactiveTemplate extends Template {
  constructor(template, data) {
    super(template, data);
  }

  render(data) {
    const values = data || this.data;
    this.output = $(this.template).clone();
    for (const key in values) {
      if (values.hasOwnProperty(key)) {
        this.re = "{\\s?" + key + "\\s?}";
        const value = values[key] instanceof Reactor ? values[key].value : values[key];
        this.output.html(this.output.html().replace(new RegExp(this.re, "ig"), value));
      }
    }
    return this.output.html();
  }
}

El.prototype.showIf = function(reactor) {
  reactor.subscribe(val => {
    this._el.style.display = val ? '' : 'none';
  });
  return this;
};

El.prototype.addClassIf = function(className, reactor) {
  reactor.subscribe(val => {
    if (val) {
      this._el.classList.add(className);
    } else {
      this._el.classList.remove(className);
    }
  });
  return this;
};

El.prototype.removeIf = function(reactor) {
  reactor.subscribe(val => {
    if (val && this._el.parentNode) {
      this._el.parentNode.removeChild(this._el);
    }
  });
  return this;
};

export class Model {
  update = function(object) {
    for (let x in object) {
      if (this.hasOwnProperty(x)) {
        this[x].value = object[x];
      }
    }
  };

  clear = function() {
    for (let x in this) {
      if (!(this[x] instanceof Function)) {
        this[x].value = null;
      }
    }
  };
}

export {
  ReactiveTemplate,
  El,
  get,
  set,
  assign,
  create,
  computed,
  Reactor
};
