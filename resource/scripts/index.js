import { Reactor, computed } from "./reactor.js";
import { get, create } from "./framework.js";

const num1 = new Reactor(0);
const num2 = new Reactor(0);
const total = computed(() => num1.value + num2.value);

const inputOptions = {
  rejectOn: isNaN,
  mutator: Number
};

const input1 = create("input").bind("value", num1, inputOptions);

const input2 = create("input").bind("value", num2, inputOptions);

const span = create("span").bind("textContent", total);

get("body")
  .append(input1)
  .append(" + ")
  .append(input2)
  .append(" = ")
  .append(span);
