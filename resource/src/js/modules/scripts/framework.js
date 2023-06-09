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

    const tagName = this._el.tagName.toLowerCase();
    const inputType = this._el.type;

    if (name === "value" && (tagName === "input" || tagName === "textarea" || tagName === "select")) {
      if (inputType === "checkbox" || inputType === "radio") {
        this.on("change", (e) => {
          let val;
          if (inputType === "checkbox") {
            val = e.target.checked ? e.target.value : '0';
          } else {
            val = e.target.checked ? e.target.value : undefined;
            if (val !== undefined) {
              const radios = document.getElementsByName(e.target.name);
              radios.forEach((radio) => {
                if (radio.checked) {
                  val = radio.value;
                }
              });
            }
          }
          if (options.rejectOn && options.rejectOn(val)) return;
          if (val !== undefined) {
            reactor.value = val;
          }
        });
      } else {
        this.on("input", (e) => {
          const val = options.mutator
            ? options.mutator(e.target.value)
            : e.target.value;
          if (options.rejectOn && options.rejectOn(val)) return;
          reactor.value = val;
        });
      }

      reactor.subscribe((val) => {
        if (tagName === "select") {
          Array.from(this._el.options).forEach(option => {
            option.selected = option.value === val;
          });
        } else if (inputType === "checkbox") {
          this._el.checked = val === this._el.value;
        } else if (inputType === "radio") {
          this._el.checked = this._el.value === val;
        } else {
          this._el[name] = val;
        }
      });
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

export function set(selector, value, attribute, options = {}) {
  const elements = document.querySelectorAll(selector);
  attribute = attribute || "textContent";

  elements.forEach((selected) => {
    const el = new El(selected);
    el.bind(attribute, value, options);
  });
}

export function assign(tag, value) {
  if (!(value instanceof Reactor) && !(value instanceof Function)) {
    value = new Reactor(value);
  }

  const tagToReplace = `{${tag}}`;
  const elements = document.body.querySelectorAll('*');

  elements.forEach((element) => {
    if (element.tagName.toLowerCase() === 'script') {
      return; // Skip processing for script tags
    }

    if (element.childNodes.length === 1 && element.firstChild.nodeType === Node.TEXT_NODE) {
      const textContent = element.textContent;

      if (textContent.includes(tagToReplace)) {
        const textParts = textContent.split(tagToReplace);
        element.textContent = '';

        textParts.forEach((part, index) => {
          element.appendChild(document.createTextNode(part));

          if (index < textParts.length - 1) {
            const span = document.createElement('span');
            span.className = `__${tag}`; // Change this line to use className
            element.appendChild(span);
          }
        });

        const els = document.getElementsByClassName(`__${tag}`); // Change this line to use getElementsByClassName
        Array.from(els).forEach((selected) => {
          const el = new El(selected);
          el.bind('textContent', value);
        });
      }
    }
  });
}

export function create(selector) {
  const el = document.createElement(selector);
  return new El(el);
}
