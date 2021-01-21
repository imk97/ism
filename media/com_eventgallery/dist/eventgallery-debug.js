/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@glidejs/glide/dist/glide.modular.esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@glidejs/glide/dist/glide.modular.esm.js ***!
  \***************************************************************/
/*! namespace exports */
/*! export Anchors [provided] [no usage info] [missing usage info prevents renaming] */
/*! export Autoplay [provided] [no usage info] [missing usage info prevents renaming] */
/*! export Breakpoints [provided] [no usage info] [missing usage info prevents renaming] */
/*! export Controls [provided] [no usage info] [missing usage info prevents renaming] */
/*! export Images [provided] [no usage info] [missing usage info prevents renaming] */
/*! export Keyboard [provided] [no usage info] [missing usage info prevents renaming] */
/*! export Swipe [provided] [no usage info] [missing usage info prevents renaming] */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__,
/* harmony export */   "Swipe": () => /* binding */ swipe,
/* harmony export */   "Images": () => /* binding */ images,
/* harmony export */   "Anchors": () => /* binding */ anchors,
/* harmony export */   "Controls": () => /* binding */ controls,
/* harmony export */   "Keyboard": () => /* binding */ keyboard,
/* harmony export */   "Autoplay": () => /* binding */ autoplay,
/* harmony export */   "Breakpoints": () => /* binding */ breakpoints
/* harmony export */ });
/*!
 * Glide.js v3.4.1
 * (c) 2013-2019 Jędrzej Chałubek <jedrzej.chalubek@gmail.com> (http://jedrzejchalubek.com/)
 * Released under the MIT License.
 */

var defaults = {
  /**
   * Type of the movement.
   *
   * Available types:
   * `slider` - Rewinds slider to the start/end when it reaches the first or last slide.
   * `carousel` - Changes slides without starting over when it reaches the first or last slide.
   *
   * @type {String}
   */
  type: 'slider',

  /**
   * Start at specific slide number defined with zero-based index.
   *
   * @type {Number}
   */
  startAt: 0,

  /**
   * A number of slides visible on the single viewport.
   *
   * @type {Number}
   */
  perView: 1,

  /**
   * Focus currently active slide at a specified position in the track.
   *
   * Available inputs:
   * `center` - Current slide will be always focused at the center of a track.
   * `0,1,2,3...` - Current slide will be focused on the specified zero-based index.
   *
   * @type {String|Number}
   */
  focusAt: 0,

  /**
   * A size of the gap added between slides.
   *
   * @type {Number}
   */
  gap: 10,

  /**
   * Change slides after a specified interval. Use `false` for turning off autoplay.
   *
   * @type {Number|Boolean}
   */
  autoplay: false,

  /**
   * Stop autoplay on mouseover event.
   *
   * @type {Boolean}
   */
  hoverpause: true,

  /**
   * Allow for changing slides with left and right keyboard arrows.
   *
   * @type {Boolean}
   */
  keyboard: true,

  /**
   * Stop running `perView` number of slides from the end. Use this
   * option if you don't want to have an empty space after
   * a slider. Works only with `slider` type and a
   * non-centered `focusAt` setting.
   *
   * @type {Boolean}
   */
  bound: false,

  /**
   * Minimal swipe distance needed to change the slide. Use `false` for turning off a swiping.
   *
   * @type {Number|Boolean}
   */
  swipeThreshold: 80,

  /**
   * Minimal mouse drag distance needed to change the slide. Use `false` for turning off a dragging.
   *
   * @type {Number|Boolean}
   */
  dragThreshold: 120,

  /**
   * A maximum number of slides to which movement will be made on swiping or dragging. Use `false` for unlimited.
   *
   * @type {Number|Boolean}
   */
  perTouch: false,

  /**
   * Moving distance ratio of the slides on a swiping and dragging.
   *
   * @type {Number}
   */
  touchRatio: 0.5,

  /**
   * Angle required to activate slides moving on swiping or dragging.
   *
   * @type {Number}
   */
  touchAngle: 45,

  /**
   * Duration of the animation in milliseconds.
   *
   * @type {Number}
   */
  animationDuration: 400,

  /**
   * Allows looping the `slider` type. Slider will rewind to the first/last slide when it's at the start/end.
   *
   * @type {Boolean}
   */
  rewind: true,

  /**
   * Duration of the rewinding animation of the `slider` type in milliseconds.
   *
   * @type {Number}
   */
  rewindDuration: 800,

  /**
   * Easing function for the animation.
   *
   * @type {String}
   */
  animationTimingFunc: 'cubic-bezier(.165, .840, .440, 1)',

  /**
   * Throttle costly events at most once per every wait milliseconds.
   *
   * @type {Number}
   */
  throttle: 10,

  /**
   * Moving direction mode.
   *
   * Available inputs:
   * - 'ltr' - left to right movement,
   * - 'rtl' - right to left movement.
   *
   * @type {String}
   */
  direction: 'ltr',

  /**
   * The distance value of the next and previous viewports which
   * have to peek in the current view. Accepts number and
   * pixels as a string. Left and right peeking can be
   * set up separately with a directions object.
   *
   * For example:
   * `100` - Peek 100px on the both sides.
   * { before: 100, after: 50 }` - Peek 100px on the left side and 50px on the right side.
   *
   * @type {Number|String|Object}
   */
  peek: 0,

  /**
   * Collection of options applied at specified media breakpoints.
   * For example: display two slides per view under 800px.
   * `{
   *   '800px': {
   *     perView: 2
   *   }
   * }`
   */
  breakpoints: {},

  /**
   * Collection of internally used HTML classes.
   *
   * @todo Refactor `slider` and `carousel` properties to single `type: { slider: '', carousel: '' }` object
   * @type {Object}
   */
  classes: {
    direction: {
      ltr: 'glide--ltr',
      rtl: 'glide--rtl'
    },
    slider: 'glide--slider',
    carousel: 'glide--carousel',
    swipeable: 'glide--swipeable',
    dragging: 'glide--dragging',
    cloneSlide: 'glide__slide--clone',
    activeNav: 'glide__bullet--active',
    activeSlide: 'glide__slide--active',
    disabledArrow: 'glide__arrow--disabled'
  }
};

/**
 * Outputs warning message to the bowser console.
 *
 * @param  {String} msg
 * @return {Void}
 */
function warn(msg) {
  console.error("[Glide warn]: " + msg);
}

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
  return typeof obj;
} : function (obj) {
  return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
};

var classCallCheck = function (instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
};

var createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);
    if (staticProps) defineProperties(Constructor, staticProps);
    return Constructor;
  };
}();

var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

var get = function get(object, property, receiver) {
  if (object === null) object = Function.prototype;
  var desc = Object.getOwnPropertyDescriptor(object, property);

  if (desc === undefined) {
    var parent = Object.getPrototypeOf(object);

    if (parent === null) {
      return undefined;
    } else {
      return get(parent, property, receiver);
    }
  } else if ("value" in desc) {
    return desc.value;
  } else {
    var getter = desc.get;

    if (getter === undefined) {
      return undefined;
    }

    return getter.call(receiver);
  }
};

var inherits = function (subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      enumerable: false,
      writable: true,
      configurable: true
    }
  });
  if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
};

var possibleConstructorReturn = function (self, call) {
  if (!self) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return call && (typeof call === "object" || typeof call === "function") ? call : self;
};

/**
 * Converts value entered as number
 * or string to integer value.
 *
 * @param {String} value
 * @returns {Number}
 */
function toInt(value) {
  return parseInt(value);
}

/**
 * Converts value entered as number
 * or string to flat value.
 *
 * @param {String} value
 * @returns {Number}
 */
function toFloat(value) {
  return parseFloat(value);
}

/**
 * Indicates whether the specified value is a string.
 *
 * @param  {*}   value
 * @return {Boolean}
 */
function isString(value) {
  return typeof value === 'string';
}

/**
 * Indicates whether the specified value is an object.
 *
 * @param  {*} value
 * @return {Boolean}
 *
 * @see https://github.com/jashkenas/underscore
 */
function isObject(value) {
  var type = typeof value === 'undefined' ? 'undefined' : _typeof(value);

  return type === 'function' || type === 'object' && !!value; // eslint-disable-line no-mixed-operators
}

/**
 * Indicates whether the specified value is a number.
 *
 * @param  {*} value
 * @return {Boolean}
 */
function isNumber(value) {
  return typeof value === 'number';
}

/**
 * Indicates whether the specified value is a function.
 *
 * @param  {*} value
 * @return {Boolean}
 */
function isFunction(value) {
  return typeof value === 'function';
}

/**
 * Indicates whether the specified value is undefined.
 *
 * @param  {*} value
 * @return {Boolean}
 */
function isUndefined(value) {
  return typeof value === 'undefined';
}

/**
 * Indicates whether the specified value is an array.
 *
 * @param  {*} value
 * @return {Boolean}
 */
function isArray(value) {
  return value.constructor === Array;
}

/**
 * Creates and initializes specified collection of extensions.
 * Each extension receives access to instance of glide and rest of components.
 *
 * @param {Object} glide
 * @param {Object} extensions
 *
 * @returns {Object}
 */
function mount(glide, extensions, events) {
  var components = {};

  for (var name in extensions) {
    if (isFunction(extensions[name])) {
      components[name] = extensions[name](glide, components, events);
    } else {
      warn('Extension must be a function');
    }
  }

  for (var _name in components) {
    if (isFunction(components[_name].mount)) {
      components[_name].mount();
    }
  }

  return components;
}

/**
 * Defines getter and setter property on the specified object.
 *
 * @param  {Object} obj         Object where property has to be defined.
 * @param  {String} prop        Name of the defined property.
 * @param  {Object} definition  Get and set definitions for the property.
 * @return {Void}
 */
function define(obj, prop, definition) {
  Object.defineProperty(obj, prop, definition);
}

/**
 * Sorts aphabetically object keys.
 *
 * @param  {Object} obj
 * @return {Object}
 */
function sortKeys(obj) {
  return Object.keys(obj).sort().reduce(function (r, k) {
    r[k] = obj[k];

    return r[k], r;
  }, {});
}

/**
 * Merges passed settings object with default options.
 *
 * @param  {Object} defaults
 * @param  {Object} settings
 * @return {Object}
 */
function mergeOptions(defaults, settings) {
  var options = _extends({}, defaults, settings);

  // `Object.assign` do not deeply merge objects, so we
  // have to do it manually for every nested object
  // in options. Although it does not look smart,
  // it's smaller and faster than some fancy
  // merging deep-merge algorithm script.
  if (settings.hasOwnProperty('classes')) {
    options.classes = _extends({}, defaults.classes, settings.classes);

    if (settings.classes.hasOwnProperty('direction')) {
      options.classes.direction = _extends({}, defaults.classes.direction, settings.classes.direction);
    }
  }

  if (settings.hasOwnProperty('breakpoints')) {
    options.breakpoints = _extends({}, defaults.breakpoints, settings.breakpoints);
  }

  return options;
}

var EventsBus = function () {
  /**
   * Construct a EventBus instance.
   *
   * @param {Object} events
   */
  function EventsBus() {
    var events = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    classCallCheck(this, EventsBus);

    this.events = events;
    this.hop = events.hasOwnProperty;
  }

  /**
   * Adds listener to the specifed event.
   *
   * @param {String|Array} event
   * @param {Function} handler
   */


  createClass(EventsBus, [{
    key: 'on',
    value: function on(event, handler) {
      if (isArray(event)) {
        for (var i = 0; i < event.length; i++) {
          this.on(event[i], handler);
        }
      }

      // Create the event's object if not yet created
      if (!this.hop.call(this.events, event)) {
        this.events[event] = [];
      }

      // Add the handler to queue
      var index = this.events[event].push(handler) - 1;

      // Provide handle back for removal of event
      return {
        remove: function remove() {
          delete this.events[event][index];
        }
      };
    }

    /**
     * Runs registered handlers for specified event.
     *
     * @param {String|Array} event
     * @param {Object=} context
     */

  }, {
    key: 'emit',
    value: function emit(event, context) {
      if (isArray(event)) {
        for (var i = 0; i < event.length; i++) {
          this.emit(event[i], context);
        }
      }

      // If the event doesn't exist, or there's no handlers in queue, just leave
      if (!this.hop.call(this.events, event)) {
        return;
      }

      // Cycle through events queue, fire!
      this.events[event].forEach(function (item) {
        item(context || {});
      });
    }
  }]);
  return EventsBus;
}();

var Glide = function () {
  /**
   * Construct glide.
   *
   * @param  {String} selector
   * @param  {Object} options
   */
  function Glide(selector) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    classCallCheck(this, Glide);

    this._c = {};
    this._t = [];
    this._e = new EventsBus();

    this.disabled = false;
    this.selector = selector;
    this.settings = mergeOptions(defaults, options);
    this.index = this.settings.startAt;
  }

  /**
   * Initializes glide.
   *
   * @param {Object} extensions Collection of extensions to initialize.
   * @return {Glide}
   */


  createClass(Glide, [{
    key: 'mount',
    value: function mount$$1() {
      var extensions = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      this._e.emit('mount.before');

      if (isObject(extensions)) {
        this._c = mount(this, extensions, this._e);
      } else {
        warn('You need to provide a object on `mount()`');
      }

      this._e.emit('mount.after');

      return this;
    }

    /**
     * Collects an instance `translate` transformers.
     *
     * @param  {Array} transformers Collection of transformers.
     * @return {Void}
     */

  }, {
    key: 'mutate',
    value: function mutate() {
      var transformers = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];

      if (isArray(transformers)) {
        this._t = transformers;
      } else {
        warn('You need to provide a array on `mutate()`');
      }

      return this;
    }

    /**
     * Updates glide with specified settings.
     *
     * @param {Object} settings
     * @return {Glide}
     */

  }, {
    key: 'update',
    value: function update() {
      var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      this.settings = mergeOptions(this.settings, settings);

      if (settings.hasOwnProperty('startAt')) {
        this.index = settings.startAt;
      }

      this._e.emit('update');

      return this;
    }

    /**
     * Change slide with specified pattern. A pattern must be in the special format:
     * `>` - Move one forward
     * `<` - Move one backward
     * `={i}` - Go to {i} zero-based slide (eq. '=1', will go to second slide)
     * `>>` - Rewinds to end (last slide)
     * `<<` - Rewinds to start (first slide)
     *
     * @param {String} pattern
     * @return {Glide}
     */

  }, {
    key: 'go',
    value: function go(pattern) {
      this._c.Run.make(pattern);

      return this;
    }

    /**
     * Move track by specified distance.
     *
     * @param {String} distance
     * @return {Glide}
     */

  }, {
    key: 'move',
    value: function move(distance) {
      this._c.Transition.disable();
      this._c.Move.make(distance);

      return this;
    }

    /**
     * Destroy instance and revert all changes done by this._c.
     *
     * @return {Glide}
     */

  }, {
    key: 'destroy',
    value: function destroy() {
      this._e.emit('destroy');

      return this;
    }

    /**
     * Start instance autoplaying.
     *
     * @param {Boolean|Number} interval Run autoplaying with passed interval regardless of `autoplay` settings
     * @return {Glide}
     */

  }, {
    key: 'play',
    value: function play() {
      var interval = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

      if (interval) {
        this.settings.autoplay = interval;
      }

      this._e.emit('play');

      return this;
    }

    /**
     * Stop instance autoplaying.
     *
     * @return {Glide}
     */

  }, {
    key: 'pause',
    value: function pause() {
      this._e.emit('pause');

      return this;
    }

    /**
     * Sets glide into a idle status.
     *
     * @return {Glide}
     */

  }, {
    key: 'disable',
    value: function disable() {
      this.disabled = true;

      return this;
    }

    /**
     * Sets glide into a active status.
     *
     * @return {Glide}
     */

  }, {
    key: 'enable',
    value: function enable() {
      this.disabled = false;

      return this;
    }

    /**
     * Adds cuutom event listener with handler.
     *
     * @param  {String|Array} event
     * @param  {Function} handler
     * @return {Glide}
     */

  }, {
    key: 'on',
    value: function on(event, handler) {
      this._e.on(event, handler);

      return this;
    }

    /**
     * Checks if glide is a precised type.
     *
     * @param  {String} name
     * @return {Boolean}
     */

  }, {
    key: 'isType',
    value: function isType(name) {
      return this.settings.type === name;
    }

    /**
     * Gets value of the core options.
     *
     * @return {Object}
     */

  }, {
    key: 'settings',
    get: function get$$1() {
      return this._o;
    }

    /**
     * Sets value of the core options.
     *
     * @param  {Object} o
     * @return {Void}
     */
    ,
    set: function set$$1(o) {
      if (isObject(o)) {
        this._o = o;
      } else {
        warn('Options must be an `object` instance.');
      }
    }

    /**
     * Gets current index of the slider.
     *
     * @return {Object}
     */

  }, {
    key: 'index',
    get: function get$$1() {
      return this._i;
    }

    /**
     * Sets current index a slider.
     *
     * @return {Object}
     */
    ,
    set: function set$$1(i) {
      this._i = toInt(i);
    }

    /**
     * Gets type name of the slider.
     *
     * @return {String}
     */

  }, {
    key: 'type',
    get: function get$$1() {
      return this.settings.type;
    }

    /**
     * Gets value of the idle status.
     *
     * @return {Boolean}
     */

  }, {
    key: 'disabled',
    get: function get$$1() {
      return this._d;
    }

    /**
     * Sets value of the idle status.
     *
     * @return {Boolean}
     */
    ,
    set: function set$$1(status) {
      this._d = !!status;
    }
  }]);
  return Glide;
}();

function Run (Glide, Components, Events) {
  var Run = {
    /**
     * Initializes autorunning of the glide.
     *
     * @return {Void}
     */
    mount: function mount() {
      this._o = false;
    },


    /**
     * Makes glides running based on the passed moving schema.
     *
     * @param {String} move
     */
    make: function make(move) {
      var _this = this;

      if (!Glide.disabled) {
        Glide.disable();

        this.move = move;

        Events.emit('run.before', this.move);

        this.calculate();

        Events.emit('run', this.move);

        Components.Transition.after(function () {
          if (_this.isStart()) {
            Events.emit('run.start', _this.move);
          }

          if (_this.isEnd()) {
            Events.emit('run.end', _this.move);
          }

          if (_this.isOffset('<') || _this.isOffset('>')) {
            _this._o = false;

            Events.emit('run.offset', _this.move);
          }

          Events.emit('run.after', _this.move);

          Glide.enable();
        });
      }
    },


    /**
     * Calculates current index based on defined move.
     *
     * @return {Void}
     */
    calculate: function calculate() {
      var move = this.move,
          length = this.length;
      var steps = move.steps,
          direction = move.direction;


      var countableSteps = isNumber(toInt(steps)) && toInt(steps) !== 0;

      switch (direction) {
        case '>':
          if (steps === '>') {
            Glide.index = length;
          } else if (this.isEnd()) {
            if (!(Glide.isType('slider') && !Glide.settings.rewind)) {
              this._o = true;

              Glide.index = 0;
            }
          } else if (countableSteps) {
            Glide.index += Math.min(length - Glide.index, -toInt(steps));
          } else {
            Glide.index++;
          }
          break;

        case '<':
          if (steps === '<') {
            Glide.index = 0;
          } else if (this.isStart()) {
            if (!(Glide.isType('slider') && !Glide.settings.rewind)) {
              this._o = true;

              Glide.index = length;
            }
          } else if (countableSteps) {
            Glide.index -= Math.min(Glide.index, toInt(steps));
          } else {
            Glide.index--;
          }
          break;

        case '=':
          Glide.index = steps;
          break;

        default:
          warn('Invalid direction pattern [' + direction + steps + '] has been used');
          break;
      }
    },


    /**
     * Checks if we are on the first slide.
     *
     * @return {Boolean}
     */
    isStart: function isStart() {
      return Glide.index === 0;
    },


    /**
     * Checks if we are on the last slide.
     *
     * @return {Boolean}
     */
    isEnd: function isEnd() {
      return Glide.index === this.length;
    },


    /**
     * Checks if we are making a offset run.
     *
     * @param {String} direction
     * @return {Boolean}
     */
    isOffset: function isOffset(direction) {
      return this._o && this.move.direction === direction;
    }
  };

  define(Run, 'move', {
    /**
     * Gets value of the move schema.
     *
     * @returns {Object}
     */
    get: function get() {
      return this._m;
    },


    /**
     * Sets value of the move schema.
     *
     * @returns {Object}
     */
    set: function set(value) {
      var step = value.substr(1);

      this._m = {
        direction: value.substr(0, 1),
        steps: step ? toInt(step) ? toInt(step) : step : 0
      };
    }
  });

  define(Run, 'length', {
    /**
     * Gets value of the running distance based
     * on zero-indexing number of slides.
     *
     * @return {Number}
     */
    get: function get() {
      var settings = Glide.settings;
      var length = Components.Html.slides.length;

      // If the `bound` option is acitve, a maximum running distance should be
      // reduced by `perView` and `focusAt` settings. Running distance
      // should end before creating an empty space after instance.

      if (Glide.isType('slider') && settings.focusAt !== 'center' && settings.bound) {
        return length - 1 - (toInt(settings.perView) - 1) + toInt(settings.focusAt);
      }

      return length - 1;
    }
  });

  define(Run, 'offset', {
    /**
     * Gets status of the offsetting flag.
     *
     * @return {Boolean}
     */
    get: function get() {
      return this._o;
    }
  });

  return Run;
}

/**
 * Returns a current time.
 *
 * @return {Number}
 */
function now() {
  return new Date().getTime();
}

/**
 * Returns a function, that, when invoked, will only be triggered
 * at most once during a given window of time.
 *
 * @param {Function} func
 * @param {Number} wait
 * @param {Object=} options
 * @return {Function}
 *
 * @see https://github.com/jashkenas/underscore
 */
function throttle(func, wait, options) {
  var timeout = void 0,
      context = void 0,
      args = void 0,
      result = void 0;
  var previous = 0;
  if (!options) options = {};

  var later = function later() {
    previous = options.leading === false ? 0 : now();
    timeout = null;
    result = func.apply(context, args);
    if (!timeout) context = args = null;
  };

  var throttled = function throttled() {
    var at = now();
    if (!previous && options.leading === false) previous = at;
    var remaining = wait - (at - previous);
    context = this;
    args = arguments;
    if (remaining <= 0 || remaining > wait) {
      if (timeout) {
        clearTimeout(timeout);
        timeout = null;
      }
      previous = at;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    } else if (!timeout && options.trailing !== false) {
      timeout = setTimeout(later, remaining);
    }
    return result;
  };

  throttled.cancel = function () {
    clearTimeout(timeout);
    previous = 0;
    timeout = context = args = null;
  };

  return throttled;
}

var MARGIN_TYPE = {
  ltr: ['marginLeft', 'marginRight'],
  rtl: ['marginRight', 'marginLeft']
};

function Gaps (Glide, Components, Events) {
  var Gaps = {
    /**
     * Applies gaps between slides. First and last
     * slides do not receive it's edge margins.
     *
     * @param {HTMLCollection} slides
     * @return {Void}
     */
    apply: function apply(slides) {
      for (var i = 0, len = slides.length; i < len; i++) {
        var style = slides[i].style;
        var direction = Components.Direction.value;

        if (i !== 0) {
          style[MARGIN_TYPE[direction][0]] = this.value / 2 + 'px';
        } else {
          style[MARGIN_TYPE[direction][0]] = '';
        }

        if (i !== slides.length - 1) {
          style[MARGIN_TYPE[direction][1]] = this.value / 2 + 'px';
        } else {
          style[MARGIN_TYPE[direction][1]] = '';
        }
      }
    },


    /**
     * Removes gaps from the slides.
     *
     * @param {HTMLCollection} slides
     * @returns {Void}
    */
    remove: function remove(slides) {
      for (var i = 0, len = slides.length; i < len; i++) {
        var style = slides[i].style;

        style.marginLeft = '';
        style.marginRight = '';
      }
    }
  };

  define(Gaps, 'value', {
    /**
     * Gets value of the gap.
     *
     * @returns {Number}
     */
    get: function get() {
      return toInt(Glide.settings.gap);
    }
  });

  define(Gaps, 'grow', {
    /**
     * Gets additional dimentions value caused by gaps.
     * Used to increase width of the slides wrapper.
     *
     * @returns {Number}
     */
    get: function get() {
      return Gaps.value * (Components.Sizes.length - 1);
    }
  });

  define(Gaps, 'reductor', {
    /**
     * Gets reduction value caused by gaps.
     * Used to subtract width of the slides.
     *
     * @returns {Number}
     */
    get: function get() {
      var perView = Glide.settings.perView;

      return Gaps.value * (perView - 1) / perView;
    }
  });

  /**
   * Apply calculated gaps:
   * - after building, so slides (including clones) will receive proper margins
   * - on updating via API, to recalculate gaps with new options
   */
  Events.on(['build.after', 'update'], throttle(function () {
    Gaps.apply(Components.Html.wrapper.children);
  }, 30));

  /**
   * Remove gaps:
   * - on destroying to bring markup to its inital state
   */
  Events.on('destroy', function () {
    Gaps.remove(Components.Html.wrapper.children);
  });

  return Gaps;
}

/**
 * Finds siblings nodes of the passed node.
 *
 * @param  {Element} node
 * @return {Array}
 */
function siblings(node) {
  if (node && node.parentNode) {
    var n = node.parentNode.firstChild;
    var matched = [];

    for (; n; n = n.nextSibling) {
      if (n.nodeType === 1 && n !== node) {
        matched.push(n);
      }
    }

    return matched;
  }

  return [];
}

/**
 * Checks if passed node exist and is a valid element.
 *
 * @param  {Element} node
 * @return {Boolean}
 */
function exist(node) {
  if (node && node instanceof window.HTMLElement) {
    return true;
  }

  return false;
}

var TRACK_SELECTOR = '[data-glide-el="track"]';

function Html (Glide, Components) {
  var Html = {
    /**
     * Setup slider HTML nodes.
     *
     * @param {Glide} glide
     */
    mount: function mount() {
      this.root = Glide.selector;
      this.track = this.root.querySelector(TRACK_SELECTOR);
      this.slides = Array.prototype.slice.call(this.wrapper.children).filter(function (slide) {
        return !slide.classList.contains(Glide.settings.classes.cloneSlide);
      });
    }
  };

  define(Html, 'root', {
    /**
     * Gets node of the glide main element.
     *
     * @return {Object}
     */
    get: function get() {
      return Html._r;
    },


    /**
     * Sets node of the glide main element.
     *
     * @return {Object}
     */
    set: function set(r) {
      if (isString(r)) {
        r = document.querySelector(r);
      }

      if (exist(r)) {
        Html._r = r;
      } else {
        warn('Root element must be a existing Html node');
      }
    }
  });

  define(Html, 'track', {
    /**
     * Gets node of the glide track with slides.
     *
     * @return {Object}
     */
    get: function get() {
      return Html._t;
    },


    /**
     * Sets node of the glide track with slides.
     *
     * @return {Object}
     */
    set: function set(t) {
      if (exist(t)) {
        Html._t = t;
      } else {
        warn('Could not find track element. Please use ' + TRACK_SELECTOR + ' attribute.');
      }
    }
  });

  define(Html, 'wrapper', {
    /**
     * Gets node of the slides wrapper.
     *
     * @return {Object}
     */
    get: function get() {
      return Html.track.children[0];
    }
  });

  return Html;
}

function Peek (Glide, Components, Events) {
  var Peek = {
    /**
     * Setups how much to peek based on settings.
     *
     * @return {Void}
     */
    mount: function mount() {
      this.value = Glide.settings.peek;
    }
  };

  define(Peek, 'value', {
    /**
     * Gets value of the peek.
     *
     * @returns {Number|Object}
     */
    get: function get() {
      return Peek._v;
    },


    /**
     * Sets value of the peek.
     *
     * @param {Number|Object} value
     * @return {Void}
     */
    set: function set(value) {
      if (isObject(value)) {
        value.before = toInt(value.before);
        value.after = toInt(value.after);
      } else {
        value = toInt(value);
      }

      Peek._v = value;
    }
  });

  define(Peek, 'reductor', {
    /**
     * Gets reduction value caused by peek.
     *
     * @returns {Number}
     */
    get: function get() {
      var value = Peek.value;
      var perView = Glide.settings.perView;

      if (isObject(value)) {
        return value.before / perView + value.after / perView;
      }

      return value * 2 / perView;
    }
  });

  /**
   * Recalculate peeking sizes on:
   * - when resizing window to update to proper percents
   */
  Events.on(['resize', 'update'], function () {
    Peek.mount();
  });

  return Peek;
}

function Move (Glide, Components, Events) {
  var Move = {
    /**
     * Constructs move component.
     *
     * @returns {Void}
     */
    mount: function mount() {
      this._o = 0;
    },


    /**
     * Calculates a movement value based on passed offset and currently active index.
     *
     * @param  {Number} offset
     * @return {Void}
     */
    make: function make() {
      var _this = this;

      var offset = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;

      this.offset = offset;

      Events.emit('move', {
        movement: this.value
      });

      Components.Transition.after(function () {
        Events.emit('move.after', {
          movement: _this.value
        });
      });
    }
  };

  define(Move, 'offset', {
    /**
     * Gets an offset value used to modify current translate.
     *
     * @return {Object}
     */
    get: function get() {
      return Move._o;
    },


    /**
     * Sets an offset value used to modify current translate.
     *
     * @return {Object}
     */
    set: function set(value) {
      Move._o = !isUndefined(value) ? toInt(value) : 0;
    }
  });

  define(Move, 'translate', {
    /**
     * Gets a raw movement value.
     *
     * @return {Number}
     */
    get: function get() {
      return Components.Sizes.slideWidth * Glide.index;
    }
  });

  define(Move, 'value', {
    /**
     * Gets an actual movement value corrected by offset.
     *
     * @return {Number}
     */
    get: function get() {
      var offset = this.offset;
      var translate = this.translate;

      if (Components.Direction.is('rtl')) {
        return translate + offset;
      }

      return translate - offset;
    }
  });

  /**
   * Make movement to proper slide on:
   * - before build, so glide will start at `startAt` index
   * - on each standard run to move to newly calculated index
   */
  Events.on(['build.before', 'run'], function () {
    Move.make();
  });

  return Move;
}

function Sizes (Glide, Components, Events) {
  var Sizes = {
    /**
     * Setups dimentions of slides.
     *
     * @return {Void}
     */
    setupSlides: function setupSlides() {
      var width = this.slideWidth + 'px';
      var slides = Components.Html.slides;

      for (var i = 0; i < slides.length; i++) {
        slides[i].style.width = width;
      }
    },


    /**
     * Setups dimentions of slides wrapper.
     *
     * @return {Void}
     */
    setupWrapper: function setupWrapper(dimention) {
      Components.Html.wrapper.style.width = this.wrapperSize + 'px';
    },


    /**
     * Removes applied styles from HTML elements.
     *
     * @returns {Void}
     */
    remove: function remove() {
      var slides = Components.Html.slides;

      for (var i = 0; i < slides.length; i++) {
        slides[i].style.width = '';
      }

      Components.Html.wrapper.style.width = '';
    }
  };

  define(Sizes, 'length', {
    /**
     * Gets count number of the slides.
     *
     * @return {Number}
     */
    get: function get() {
      return Components.Html.slides.length;
    }
  });

  define(Sizes, 'width', {
    /**
     * Gets width value of the glide.
     *
     * @return {Number}
     */
    get: function get() {
      return Components.Html.root.offsetWidth;
    }
  });

  define(Sizes, 'wrapperSize', {
    /**
     * Gets size of the slides wrapper.
     *
     * @return {Number}
     */
    get: function get() {
      return Sizes.slideWidth * Sizes.length + Components.Gaps.grow + Components.Clones.grow;
    }
  });

  define(Sizes, 'slideWidth', {
    /**
     * Gets width value of the single slide.
     *
     * @return {Number}
     */
    get: function get() {
      return Sizes.width / Glide.settings.perView - Components.Peek.reductor - Components.Gaps.reductor;
    }
  });

  /**
   * Apply calculated glide's dimensions:
   * - before building, so other dimentions (e.g. translate) will be calculated propertly
   * - when resizing window to recalculate sildes dimensions
   * - on updating via API, to calculate dimensions based on new options
   */
  Events.on(['build.before', 'resize', 'update'], function () {
    Sizes.setupSlides();
    Sizes.setupWrapper();
  });

  /**
   * Remove calculated glide's dimensions:
   * - on destoting to bring markup to its inital state
   */
  Events.on('destroy', function () {
    Sizes.remove();
  });

  return Sizes;
}

function Build (Glide, Components, Events) {
  var Build = {
    /**
     * Init glide building. Adds classes, sets
     * dimensions and setups initial state.
     *
     * @return {Void}
     */
    mount: function mount() {
      Events.emit('build.before');

      this.typeClass();
      this.activeClass();

      Events.emit('build.after');
    },


    /**
     * Adds `type` class to the glide element.
     *
     * @return {Void}
     */
    typeClass: function typeClass() {
      Components.Html.root.classList.add(Glide.settings.classes[Glide.settings.type]);
    },


    /**
     * Sets active class to current slide.
     *
     * @return {Void}
     */
    activeClass: function activeClass() {
      var classes = Glide.settings.classes;
      var slide = Components.Html.slides[Glide.index];

      if (slide) {
        slide.classList.add(classes.activeSlide);

        siblings(slide).forEach(function (sibling) {
          sibling.classList.remove(classes.activeSlide);
        });
      }
    },


    /**
     * Removes HTML classes applied at building.
     *
     * @return {Void}
     */
    removeClasses: function removeClasses() {
      var classes = Glide.settings.classes;

      Components.Html.root.classList.remove(classes[Glide.settings.type]);

      Components.Html.slides.forEach(function (sibling) {
        sibling.classList.remove(classes.activeSlide);
      });
    }
  };

  /**
   * Clear building classes:
   * - on destroying to bring HTML to its initial state
   * - on updating to remove classes before remounting component
   */
  Events.on(['destroy', 'update'], function () {
    Build.removeClasses();
  });

  /**
   * Remount component:
   * - on resizing of the window to calculate new dimentions
   * - on updating settings via API
   */
  Events.on(['resize', 'update'], function () {
    Build.mount();
  });

  /**
   * Swap active class of current slide:
   * - after each move to the new index
   */
  Events.on('move.after', function () {
    Build.activeClass();
  });

  return Build;
}

function Clones (Glide, Components, Events) {
  var Clones = {
    /**
     * Create pattern map and collect slides to be cloned.
     */
    mount: function mount() {
      this.items = [];

      if (Glide.isType('carousel')) {
        this.items = this.collect();
      }
    },


    /**
     * Collect clones with pattern.
     *
     * @return {Void}
     */
    collect: function collect() {
      var items = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
      var slides = Components.Html.slides;
      var _Glide$settings = Glide.settings,
          perView = _Glide$settings.perView,
          classes = _Glide$settings.classes;


      var peekIncrementer = +!!Glide.settings.peek;
      var part = perView + peekIncrementer;
      var start = slides.slice(0, part);
      var end = slides.slice(-part);

      for (var r = 0; r < Math.max(1, Math.floor(perView / slides.length)); r++) {
        for (var i = 0; i < start.length; i++) {
          var clone = start[i].cloneNode(true);

          clone.classList.add(classes.cloneSlide);

          items.push(clone);
        }

        for (var _i = 0; _i < end.length; _i++) {
          var _clone = end[_i].cloneNode(true);

          _clone.classList.add(classes.cloneSlide);

          items.unshift(_clone);
        }
      }

      return items;
    },


    /**
     * Append cloned slides with generated pattern.
     *
     * @return {Void}
     */
    append: function append() {
      var items = this.items;
      var _Components$Html = Components.Html,
          wrapper = _Components$Html.wrapper,
          slides = _Components$Html.slides;


      var half = Math.floor(items.length / 2);
      var prepend = items.slice(0, half).reverse();
      var append = items.slice(half, items.length);
      var width = Components.Sizes.slideWidth + 'px';

      for (var i = 0; i < append.length; i++) {
        wrapper.appendChild(append[i]);
      }

      for (var _i2 = 0; _i2 < prepend.length; _i2++) {
        wrapper.insertBefore(prepend[_i2], slides[0]);
      }

      for (var _i3 = 0; _i3 < items.length; _i3++) {
        items[_i3].style.width = width;
      }
    },


    /**
     * Remove all cloned slides.
     *
     * @return {Void}
     */
    remove: function remove() {
      var items = this.items;


      for (var i = 0; i < items.length; i++) {
        Components.Html.wrapper.removeChild(items[i]);
      }
    }
  };

  define(Clones, 'grow', {
    /**
     * Gets additional dimentions value caused by clones.
     *
     * @return {Number}
     */
    get: function get() {
      return (Components.Sizes.slideWidth + Components.Gaps.value) * Clones.items.length;
    }
  });

  /**
   * Append additional slide's clones:
   * - while glide's type is `carousel`
   */
  Events.on('update', function () {
    Clones.remove();
    Clones.mount();
    Clones.append();
  });

  /**
   * Append additional slide's clones:
   * - while glide's type is `carousel`
   */
  Events.on('build.before', function () {
    if (Glide.isType('carousel')) {
      Clones.append();
    }
  });

  /**
   * Remove clones HTMLElements:
   * - on destroying, to bring HTML to its initial state
   */
  Events.on('destroy', function () {
    Clones.remove();
  });

  return Clones;
}

var EventsBinder = function () {
  /**
   * Construct a EventsBinder instance.
   */
  function EventsBinder() {
    var listeners = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    classCallCheck(this, EventsBinder);

    this.listeners = listeners;
  }

  /**
   * Adds events listeners to arrows HTML elements.
   *
   * @param  {String|Array} events
   * @param  {Element|Window|Document} el
   * @param  {Function} closure
   * @param  {Boolean|Object} capture
   * @return {Void}
   */


  createClass(EventsBinder, [{
    key: 'on',
    value: function on(events, el, closure) {
      var capture = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;

      if (isString(events)) {
        events = [events];
      }

      for (var i = 0; i < events.length; i++) {
        this.listeners[events[i]] = closure;

        el.addEventListener(events[i], this.listeners[events[i]], capture);
      }
    }

    /**
     * Removes event listeners from arrows HTML elements.
     *
     * @param  {String|Array} events
     * @param  {Element|Window|Document} el
     * @param  {Boolean|Object} capture
     * @return {Void}
     */

  }, {
    key: 'off',
    value: function off(events, el) {
      var capture = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

      if (isString(events)) {
        events = [events];
      }

      for (var i = 0; i < events.length; i++) {
        el.removeEventListener(events[i], this.listeners[events[i]], capture);
      }
    }

    /**
     * Destroy collected listeners.
     *
     * @returns {Void}
     */

  }, {
    key: 'destroy',
    value: function destroy() {
      delete this.listeners;
    }
  }]);
  return EventsBinder;
}();

function Resize (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  var Resize = {
    /**
     * Initializes window bindings.
     */
    mount: function mount() {
      this.bind();
    },


    /**
     * Binds `rezsize` listener to the window.
     * It's a costly event, so we are debouncing it.
     *
     * @return {Void}
     */
    bind: function bind() {
      Binder.on('resize', window, throttle(function () {
        Events.emit('resize');
      }, Glide.settings.throttle));
    },


    /**
     * Unbinds listeners from the window.
     *
     * @return {Void}
     */
    unbind: function unbind() {
      Binder.off('resize', window);
    }
  };

  /**
   * Remove bindings from window:
   * - on destroying, to remove added EventListener
   */
  Events.on('destroy', function () {
    Resize.unbind();
    Binder.destroy();
  });

  return Resize;
}

var VALID_DIRECTIONS = ['ltr', 'rtl'];
var FLIPED_MOVEMENTS = {
  '>': '<',
  '<': '>',
  '=': '='
};

function Direction (Glide, Components, Events) {
  var Direction = {
    /**
     * Setups gap value based on settings.
     *
     * @return {Void}
     */
    mount: function mount() {
      this.value = Glide.settings.direction;
    },


    /**
     * Resolves pattern based on direction value
     *
     * @param {String} pattern
     * @returns {String}
     */
    resolve: function resolve(pattern) {
      var token = pattern.slice(0, 1);

      if (this.is('rtl')) {
        return pattern.split(token).join(FLIPED_MOVEMENTS[token]);
      }

      return pattern;
    },


    /**
     * Checks value of direction mode.
     *
     * @param {String} direction
     * @returns {Boolean}
     */
    is: function is(direction) {
      return this.value === direction;
    },


    /**
     * Applies direction class to the root HTML element.
     *
     * @return {Void}
     */
    addClass: function addClass() {
      Components.Html.root.classList.add(Glide.settings.classes.direction[this.value]);
    },


    /**
     * Removes direction class from the root HTML element.
     *
     * @return {Void}
     */
    removeClass: function removeClass() {
      Components.Html.root.classList.remove(Glide.settings.classes.direction[this.value]);
    }
  };

  define(Direction, 'value', {
    /**
     * Gets value of the direction.
     *
     * @returns {Number}
     */
    get: function get() {
      return Direction._v;
    },


    /**
     * Sets value of the direction.
     *
     * @param {String} value
     * @return {Void}
     */
    set: function set(value) {
      if (VALID_DIRECTIONS.indexOf(value) > -1) {
        Direction._v = value;
      } else {
        warn('Direction value must be `ltr` or `rtl`');
      }
    }
  });

  /**
   * Clear direction class:
   * - on destroy to bring HTML to its initial state
   * - on update to remove class before reappling bellow
   */
  Events.on(['destroy', 'update'], function () {
    Direction.removeClass();
  });

  /**
   * Remount component:
   * - on update to reflect changes in direction value
   */
  Events.on('update', function () {
    Direction.mount();
  });

  /**
   * Apply direction class:
   * - before building to apply class for the first time
   * - on updating to reapply direction class that may changed
   */
  Events.on(['build.before', 'update'], function () {
    Direction.addClass();
  });

  return Direction;
}

/**
 * Reflects value of glide movement.
 *
 * @param  {Object} Glide
 * @param  {Object} Components
 * @return {Object}
 */
function Rtl (Glide, Components) {
  return {
    /**
     * Negates the passed translate if glide is in RTL option.
     *
     * @param  {Number} translate
     * @return {Number}
     */
    modify: function modify(translate) {
      if (Components.Direction.is('rtl')) {
        return -translate;
      }

      return translate;
    }
  };
}

/**
 * Updates glide movement with a `gap` settings.
 *
 * @param  {Object} Glide
 * @param  {Object} Components
 * @return {Object}
 */
function Gap (Glide, Components) {
  return {
    /**
     * Modifies passed translate value with number in the `gap` settings.
     *
     * @param  {Number} translate
     * @return {Number}
     */
    modify: function modify(translate) {
      return translate + Components.Gaps.value * Glide.index;
    }
  };
}

/**
 * Updates glide movement with width of additional clones width.
 *
 * @param  {Object} Glide
 * @param  {Object} Components
 * @return {Object}
 */
function Grow (Glide, Components) {
  return {
    /**
     * Adds to the passed translate width of the half of clones.
     *
     * @param  {Number} translate
     * @return {Number}
     */
    modify: function modify(translate) {
      return translate + Components.Clones.grow / 2;
    }
  };
}

/**
 * Updates glide movement with a `peek` settings.
 *
 * @param  {Object} Glide
 * @param  {Object} Components
 * @return {Object}
 */
function Peeking (Glide, Components) {
  return {
    /**
     * Modifies passed translate value with a `peek` setting.
     *
     * @param  {Number} translate
     * @return {Number}
     */
    modify: function modify(translate) {
      if (Glide.settings.focusAt >= 0) {
        var peek = Components.Peek.value;

        if (isObject(peek)) {
          return translate - peek.before;
        }

        return translate - peek;
      }

      return translate;
    }
  };
}

/**
 * Updates glide movement with a `focusAt` settings.
 *
 * @param  {Object} Glide
 * @param  {Object} Components
 * @return {Object}
 */
function Focusing (Glide, Components) {
  return {
    /**
     * Modifies passed translate value with index in the `focusAt` setting.
     *
     * @param  {Number} translate
     * @return {Number}
     */
    modify: function modify(translate) {
      var gap = Components.Gaps.value;
      var width = Components.Sizes.width;
      var focusAt = Glide.settings.focusAt;
      var slideWidth = Components.Sizes.slideWidth;

      if (focusAt === 'center') {
        return translate - (width / 2 - slideWidth / 2);
      }

      return translate - slideWidth * focusAt - gap * focusAt;
    }
  };
}

/**
 * Applies diffrent transformers on translate value.
 *
 * @param  {Object} Glide
 * @param  {Object} Components
 * @return {Object}
 */
function mutator (Glide, Components, Events) {
  /**
   * Merge instance transformers with collection of default transformers.
   * It's important that the Rtl component be last on the list,
   * so it reflects all previous transformations.
   *
   * @type {Array}
   */
  var TRANSFORMERS = [Gap, Grow, Peeking, Focusing].concat(Glide._t, [Rtl]);

  return {
    /**
     * Piplines translate value with registered transformers.
     *
     * @param  {Number} translate
     * @return {Number}
     */
    mutate: function mutate(translate) {
      for (var i = 0; i < TRANSFORMERS.length; i++) {
        var transformer = TRANSFORMERS[i];

        if (isFunction(transformer) && isFunction(transformer().modify)) {
          translate = transformer(Glide, Components, Events).modify(translate);
        } else {
          warn('Transformer should be a function that returns an object with `modify()` method');
        }
      }

      return translate;
    }
  };
}

function Translate (Glide, Components, Events) {
  var Translate = {
    /**
     * Sets value of translate on HTML element.
     *
     * @param {Number} value
     * @return {Void}
     */
    set: function set(value) {
      var transform = mutator(Glide, Components).mutate(value);

      Components.Html.wrapper.style.transform = 'translate3d(' + -1 * transform + 'px, 0px, 0px)';
    },


    /**
     * Removes value of translate from HTML element.
     *
     * @return {Void}
     */
    remove: function remove() {
      Components.Html.wrapper.style.transform = '';
    }
  };

  /**
   * Set new translate value:
   * - on move to reflect index change
   * - on updating via API to reflect possible changes in options
   */
  Events.on('move', function (context) {
    var gap = Components.Gaps.value;
    var length = Components.Sizes.length;
    var width = Components.Sizes.slideWidth;

    if (Glide.isType('carousel') && Components.Run.isOffset('<')) {
      Components.Transition.after(function () {
        Events.emit('translate.jump');

        Translate.set(width * (length - 1));
      });

      return Translate.set(-width - gap * length);
    }

    if (Glide.isType('carousel') && Components.Run.isOffset('>')) {
      Components.Transition.after(function () {
        Events.emit('translate.jump');

        Translate.set(0);
      });

      return Translate.set(width * length + gap * length);
    }

    return Translate.set(context.movement);
  });

  /**
   * Remove translate:
   * - on destroying to bring markup to its inital state
   */
  Events.on('destroy', function () {
    Translate.remove();
  });

  return Translate;
}

function Transition (Glide, Components, Events) {
  /**
   * Holds inactivity status of transition.
   * When true transition is not applied.
   *
   * @type {Boolean}
   */
  var disabled = false;

  var Transition = {
    /**
     * Composes string of the CSS transition.
     *
     * @param {String} property
     * @return {String}
     */
    compose: function compose(property) {
      var settings = Glide.settings;

      if (!disabled) {
        return property + ' ' + this.duration + 'ms ' + settings.animationTimingFunc;
      }

      return property + ' 0ms ' + settings.animationTimingFunc;
    },


    /**
     * Sets value of transition on HTML element.
     *
     * @param {String=} property
     * @return {Void}
     */
    set: function set() {
      var property = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'transform';

      Components.Html.wrapper.style.transition = this.compose(property);
    },


    /**
     * Removes value of transition from HTML element.
     *
     * @return {Void}
     */
    remove: function remove() {
      Components.Html.wrapper.style.transition = '';
    },


    /**
     * Runs callback after animation.
     *
     * @param  {Function} callback
     * @return {Void}
     */
    after: function after(callback) {
      setTimeout(function () {
        callback();
      }, this.duration);
    },


    /**
     * Enable transition.
     *
     * @return {Void}
     */
    enable: function enable() {
      disabled = false;

      this.set();
    },


    /**
     * Disable transition.
     *
     * @return {Void}
     */
    disable: function disable() {
      disabled = true;

      this.set();
    }
  };

  define(Transition, 'duration', {
    /**
     * Gets duration of the transition based
     * on currently running animation type.
     *
     * @return {Number}
     */
    get: function get() {
      var settings = Glide.settings;

      if (Glide.isType('slider') && Components.Run.offset) {
        return settings.rewindDuration;
      }

      return settings.animationDuration;
    }
  });

  /**
   * Set transition `style` value:
   * - on each moving, because it may be cleared by offset move
   */
  Events.on('move', function () {
    Transition.set();
  });

  /**
   * Disable transition:
   * - before initial build to avoid transitioning from `0` to `startAt` index
   * - while resizing window and recalculating dimentions
   * - on jumping from offset transition at start and end edges in `carousel` type
   */
  Events.on(['build.before', 'resize', 'translate.jump'], function () {
    Transition.disable();
  });

  /**
   * Enable transition:
   * - on each running, because it may be disabled by offset move
   */
  Events.on('run', function () {
    Transition.enable();
  });

  /**
   * Remove transition:
   * - on destroying to bring markup to its inital state
   */
  Events.on('destroy', function () {
    Transition.remove();
  });

  return Transition;
}

/**
 * Test via a getter in the options object to see
 * if the passive property is accessed.
 *
 * @see https://github.com/WICG/EventListenerOptions/blob/gh-pages/explainer.md#feature-detection
 */

var supportsPassive = false;

try {
  var opts = Object.defineProperty({}, 'passive', {
    get: function get() {
      supportsPassive = true;
    }
  });

  window.addEventListener('testPassive', null, opts);
  window.removeEventListener('testPassive', null, opts);
} catch (e) {}

var supportsPassive$1 = supportsPassive;

var START_EVENTS = ['touchstart', 'mousedown'];
var MOVE_EVENTS = ['touchmove', 'mousemove'];
var END_EVENTS = ['touchend', 'touchcancel', 'mouseup', 'mouseleave'];
var MOUSE_EVENTS = ['mousedown', 'mousemove', 'mouseup', 'mouseleave'];

function swipe (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  var swipeSin = 0;
  var swipeStartX = 0;
  var swipeStartY = 0;
  var disabled = false;
  var capture = supportsPassive$1 ? { passive: true } : false;

  var Swipe = {
    /**
     * Initializes swipe bindings.
     *
     * @return {Void}
     */
    mount: function mount() {
      this.bindSwipeStart();
    },


    /**
     * Handler for `swipestart` event. Calculates entry points of the user's tap.
     *
     * @param {Object} event
     * @return {Void}
     */
    start: function start(event) {
      if (!disabled && !Glide.disabled) {
        this.disable();

        var swipe = this.touches(event);

        swipeSin = null;
        swipeStartX = toInt(swipe.pageX);
        swipeStartY = toInt(swipe.pageY);

        this.bindSwipeMove();
        this.bindSwipeEnd();

        Events.emit('swipe.start');
      }
    },


    /**
     * Handler for `swipemove` event. Calculates user's tap angle and distance.
     *
     * @param {Object} event
     */
    move: function move(event) {
      if (!Glide.disabled) {
        var _Glide$settings = Glide.settings,
            touchAngle = _Glide$settings.touchAngle,
            touchRatio = _Glide$settings.touchRatio,
            classes = _Glide$settings.classes;


        var swipe = this.touches(event);

        var subExSx = toInt(swipe.pageX) - swipeStartX;
        var subEySy = toInt(swipe.pageY) - swipeStartY;
        var powEX = Math.abs(subExSx << 2);
        var powEY = Math.abs(subEySy << 2);
        var swipeHypotenuse = Math.sqrt(powEX + powEY);
        var swipeCathetus = Math.sqrt(powEY);

        swipeSin = Math.asin(swipeCathetus / swipeHypotenuse);

        if (swipeSin * 180 / Math.PI < touchAngle) {
          event.stopPropagation();

          Components.Move.make(subExSx * toFloat(touchRatio));

          Components.Html.root.classList.add(classes.dragging);

          Events.emit('swipe.move');
        } else {
          return false;
        }
      }
    },


    /**
     * Handler for `swipeend` event. Finitializes user's tap and decides about glide move.
     *
     * @param {Object} event
     * @return {Void}
     */
    end: function end(event) {
      if (!Glide.disabled) {
        var settings = Glide.settings;

        var swipe = this.touches(event);
        var threshold = this.threshold(event);

        var swipeDistance = swipe.pageX - swipeStartX;
        var swipeDeg = swipeSin * 180 / Math.PI;
        var steps = Math.round(swipeDistance / Components.Sizes.slideWidth);

        this.enable();

        if (swipeDistance > threshold && swipeDeg < settings.touchAngle) {
          // While swipe is positive and greater than threshold move backward.
          if (settings.perTouch) {
            steps = Math.min(steps, toInt(settings.perTouch));
          }

          if (Components.Direction.is('rtl')) {
            steps = -steps;
          }

          Components.Run.make(Components.Direction.resolve('<' + steps));
        } else if (swipeDistance < -threshold && swipeDeg < settings.touchAngle) {
          // While swipe is negative and lower than negative threshold move forward.
          if (settings.perTouch) {
            steps = Math.max(steps, -toInt(settings.perTouch));
          }

          if (Components.Direction.is('rtl')) {
            steps = -steps;
          }

          Components.Run.make(Components.Direction.resolve('>' + steps));
        } else {
          // While swipe don't reach distance apply previous transform.
          Components.Move.make();
        }

        Components.Html.root.classList.remove(settings.classes.dragging);

        this.unbindSwipeMove();
        this.unbindSwipeEnd();

        Events.emit('swipe.end');
      }
    },


    /**
     * Binds swipe's starting event.
     *
     * @return {Void}
     */
    bindSwipeStart: function bindSwipeStart() {
      var _this = this;

      var settings = Glide.settings;

      if (settings.swipeThreshold) {
        Binder.on(START_EVENTS[0], Components.Html.wrapper, function (event) {
          _this.start(event);
        }, capture);
      }

      if (settings.dragThreshold) {
        Binder.on(START_EVENTS[1], Components.Html.wrapper, function (event) {
          _this.start(event);
        }, capture);
      }
    },


    /**
     * Unbinds swipe's starting event.
     *
     * @return {Void}
     */
    unbindSwipeStart: function unbindSwipeStart() {
      Binder.off(START_EVENTS[0], Components.Html.wrapper, capture);
      Binder.off(START_EVENTS[1], Components.Html.wrapper, capture);
    },


    /**
     * Binds swipe's moving event.
     *
     * @return {Void}
     */
    bindSwipeMove: function bindSwipeMove() {
      var _this2 = this;

      Binder.on(MOVE_EVENTS, Components.Html.wrapper, throttle(function (event) {
        _this2.move(event);
      }, Glide.settings.throttle), capture);
    },


    /**
     * Unbinds swipe's moving event.
     *
     * @return {Void}
     */
    unbindSwipeMove: function unbindSwipeMove() {
      Binder.off(MOVE_EVENTS, Components.Html.wrapper, capture);
    },


    /**
     * Binds swipe's ending event.
     *
     * @return {Void}
     */
    bindSwipeEnd: function bindSwipeEnd() {
      var _this3 = this;

      Binder.on(END_EVENTS, Components.Html.wrapper, function (event) {
        _this3.end(event);
      });
    },


    /**
     * Unbinds swipe's ending event.
     *
     * @return {Void}
     */
    unbindSwipeEnd: function unbindSwipeEnd() {
      Binder.off(END_EVENTS, Components.Html.wrapper);
    },


    /**
     * Normalizes event touches points accorting to different types.
     *
     * @param {Object} event
     */
    touches: function touches(event) {
      if (MOUSE_EVENTS.indexOf(event.type) > -1) {
        return event;
      }

      return event.touches[0] || event.changedTouches[0];
    },


    /**
     * Gets value of minimum swipe distance settings based on event type.
     *
     * @return {Number}
     */
    threshold: function threshold(event) {
      var settings = Glide.settings;

      if (MOUSE_EVENTS.indexOf(event.type) > -1) {
        return settings.dragThreshold;
      }

      return settings.swipeThreshold;
    },


    /**
     * Enables swipe event.
     *
     * @return {self}
     */
    enable: function enable() {
      disabled = false;

      Components.Transition.enable();

      return this;
    },


    /**
     * Disables swipe event.
     *
     * @return {self}
     */
    disable: function disable() {
      disabled = true;

      Components.Transition.disable();

      return this;
    }
  };

  /**
   * Add component class:
   * - after initial building
   */
  Events.on('build.after', function () {
    Components.Html.root.classList.add(Glide.settings.classes.swipeable);
  });

  /**
   * Remove swiping bindings:
   * - on destroying, to remove added EventListeners
   */
  Events.on('destroy', function () {
    Swipe.unbindSwipeStart();
    Swipe.unbindSwipeMove();
    Swipe.unbindSwipeEnd();
    Binder.destroy();
  });

  return Swipe;
}

function images (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  var Images = {
    /**
     * Binds listener to glide wrapper.
     *
     * @return {Void}
     */
    mount: function mount() {
      this.bind();
    },


    /**
     * Binds `dragstart` event on wrapper to prevent dragging images.
     *
     * @return {Void}
     */
    bind: function bind() {
      Binder.on('dragstart', Components.Html.wrapper, this.dragstart);
    },


    /**
     * Unbinds `dragstart` event on wrapper.
     *
     * @return {Void}
     */
    unbind: function unbind() {
      Binder.off('dragstart', Components.Html.wrapper);
    },


    /**
     * Event handler. Prevents dragging.
     *
     * @return {Void}
     */
    dragstart: function dragstart(event) {
      event.preventDefault();
    }
  };

  /**
   * Remove bindings from images:
   * - on destroying, to remove added EventListeners
   */
  Events.on('destroy', function () {
    Images.unbind();
    Binder.destroy();
  });

  return Images;
}

function anchors (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  /**
   * Holds detaching status of anchors.
   * Prevents detaching of already detached anchors.
   *
   * @private
   * @type {Boolean}
   */
  var detached = false;

  /**
   * Holds preventing status of anchors.
   * If `true` redirection after click will be disabled.
   *
   * @private
   * @type {Boolean}
   */
  var prevented = false;

  var Anchors = {
    /**
     * Setups a initial state of anchors component.
     *
     * @returns {Void}
     */
    mount: function mount() {
      /**
       * Holds collection of anchors elements.
       *
       * @private
       * @type {HTMLCollection}
       */
      this._a = Components.Html.wrapper.querySelectorAll('a');

      this.bind();
    },


    /**
     * Binds events to anchors inside a track.
     *
     * @return {Void}
     */
    bind: function bind() {
      Binder.on('click', Components.Html.wrapper, this.click);
    },


    /**
     * Unbinds events attached to anchors inside a track.
     *
     * @return {Void}
     */
    unbind: function unbind() {
      Binder.off('click', Components.Html.wrapper);
    },


    /**
     * Handler for click event. Prevents clicks when glide is in `prevent` status.
     *
     * @param  {Object} event
     * @return {Void}
     */
    click: function click(event) {
      if (prevented) {
        event.stopPropagation();
        event.preventDefault();
      }
    },


    /**
     * Detaches anchors click event inside glide.
     *
     * @return {self}
     */
    detach: function detach() {
      prevented = true;

      if (!detached) {
        for (var i = 0; i < this.items.length; i++) {
          this.items[i].draggable = false;

          this.items[i].setAttribute('data-href', this.items[i].getAttribute('href'));

          this.items[i].removeAttribute('href');
        }

        detached = true;
      }

      return this;
    },


    /**
     * Attaches anchors click events inside glide.
     *
     * @return {self}
     */
    attach: function attach() {
      prevented = false;

      if (detached) {
        for (var i = 0; i < this.items.length; i++) {
          this.items[i].draggable = true;

          this.items[i].setAttribute('href', this.items[i].getAttribute('data-href'));
        }

        detached = false;
      }

      return this;
    }
  };

  define(Anchors, 'items', {
    /**
     * Gets collection of the arrows HTML elements.
     *
     * @return {HTMLElement[]}
     */
    get: function get() {
      return Anchors._a;
    }
  });

  /**
   * Detach anchors inside slides:
   * - on swiping, so they won't redirect to its `href` attributes
   */
  Events.on('swipe.move', function () {
    Anchors.detach();
  });

  /**
   * Attach anchors inside slides:
   * - after swiping and transitions ends, so they can redirect after click again
   */
  Events.on('swipe.end', function () {
    Components.Transition.after(function () {
      Anchors.attach();
    });
  });

  /**
   * Unbind anchors inside slides:
   * - on destroying, to bring anchors to its initial state
   */
  Events.on('destroy', function () {
    Anchors.attach();
    Anchors.unbind();
    Binder.destroy();
  });

  return Anchors;
}

var NAV_SELECTOR = '[data-glide-el="controls[nav]"]';
var CONTROLS_SELECTOR = '[data-glide-el^="controls"]';

function controls (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  var capture = supportsPassive$1 ? { passive: true } : false;

  var Controls = {
    /**
     * Inits arrows. Binds events listeners
     * to the arrows HTML elements.
     *
     * @return {Void}
     */
    mount: function mount() {
      /**
       * Collection of navigation HTML elements.
       *
       * @private
       * @type {HTMLCollection}
       */
      this._n = Components.Html.root.querySelectorAll(NAV_SELECTOR);

      /**
       * Collection of controls HTML elements.
       *
       * @private
       * @type {HTMLCollection}
       */
      this._c = Components.Html.root.querySelectorAll(CONTROLS_SELECTOR);

      this.addBindings();
    },


    /**
     * Sets active class to current slide.
     *
     * @return {Void}
     */
    setActive: function setActive() {
      for (var i = 0; i < this._n.length; i++) {
        this.addClass(this._n[i].children);
      }
    },


    /**
     * Removes active class to current slide.
     *
     * @return {Void}
     */
    removeActive: function removeActive() {
      for (var i = 0; i < this._n.length; i++) {
        this.removeClass(this._n[i].children);
      }
    },


    /**
     * Toggles active class on items inside navigation.
     *
     * @param  {HTMLElement} controls
     * @return {Void}
     */
    addClass: function addClass(controls) {
      var settings = Glide.settings;
      var item = controls[Glide.index];

      if (item) {
        item.classList.add(settings.classes.activeNav);

        siblings(item).forEach(function (sibling) {
          sibling.classList.remove(settings.classes.activeNav);
        });
      }
    },


    /**
     * Removes active class from active control.
     *
     * @param  {HTMLElement} controls
     * @return {Void}
     */
    removeClass: function removeClass(controls) {
      var item = controls[Glide.index];

      if (item) {
        item.classList.remove(Glide.settings.classes.activeNav);
      }
    },


    /**
     * Adds handles to the each group of controls.
     *
     * @return {Void}
     */
    addBindings: function addBindings() {
      for (var i = 0; i < this._c.length; i++) {
        this.bind(this._c[i].children);
      }
    },


    /**
     * Removes handles from the each group of controls.
     *
     * @return {Void}
     */
    removeBindings: function removeBindings() {
      for (var i = 0; i < this._c.length; i++) {
        this.unbind(this._c[i].children);
      }
    },


    /**
     * Binds events to arrows HTML elements.
     *
     * @param {HTMLCollection} elements
     * @return {Void}
     */
    bind: function bind(elements) {
      for (var i = 0; i < elements.length; i++) {
        Binder.on('click', elements[i], this.click);
        Binder.on('touchstart', elements[i], this.click, capture);
      }
    },


    /**
     * Unbinds events binded to the arrows HTML elements.
     *
     * @param {HTMLCollection} elements
     * @return {Void}
     */
    unbind: function unbind(elements) {
      for (var i = 0; i < elements.length; i++) {
        Binder.off(['click', 'touchstart'], elements[i]);
      }
    },


    /**
     * Handles `click` event on the arrows HTML elements.
     * Moves slider in driection precised in
     * `data-glide-dir` attribute.
     *
     * @param {Object} event
     * @return {Void}
     */
    click: function click(event) {
      event.preventDefault();

      Components.Run.make(Components.Direction.resolve(event.currentTarget.getAttribute('data-glide-dir')));
    }
  };

  define(Controls, 'items', {
    /**
     * Gets collection of the controls HTML elements.
     *
     * @return {HTMLElement[]}
     */
    get: function get() {
      return Controls._c;
    }
  });

  /**
   * Swap active class of current navigation item:
   * - after mounting to set it to initial index
   * - after each move to the new index
   */
  Events.on(['mount.after', 'move.after'], function () {
    Controls.setActive();
  });

  /**
   * Remove bindings and HTML Classes:
   * - on destroying, to bring markup to its initial state
   */
  Events.on('destroy', function () {
    Controls.removeBindings();
    Controls.removeActive();
    Binder.destroy();
  });

  return Controls;
}

function keyboard (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  var Keyboard = {
    /**
     * Binds keyboard events on component mount.
     *
     * @return {Void}
     */
    mount: function mount() {
      if (Glide.settings.keyboard) {
        this.bind();
      }
    },


    /**
     * Adds keyboard press events.
     *
     * @return {Void}
     */
    bind: function bind() {
      Binder.on('keyup', document, this.press);
    },


    /**
     * Removes keyboard press events.
     *
     * @return {Void}
     */
    unbind: function unbind() {
      Binder.off('keyup', document);
    },


    /**
     * Handles keyboard's arrows press and moving glide foward and backward.
     *
     * @param  {Object} event
     * @return {Void}
     */
    press: function press(event) {
      if (event.keyCode === 39) {
        Components.Run.make(Components.Direction.resolve('>'));
      }

      if (event.keyCode === 37) {
        Components.Run.make(Components.Direction.resolve('<'));
      }
    }
  };

  /**
   * Remove bindings from keyboard:
   * - on destroying to remove added events
   * - on updating to remove events before remounting
   */
  Events.on(['destroy', 'update'], function () {
    Keyboard.unbind();
  });

  /**
   * Remount component
   * - on updating to reflect potential changes in settings
   */
  Events.on('update', function () {
    Keyboard.mount();
  });

  /**
   * Destroy binder:
   * - on destroying to remove listeners
   */
  Events.on('destroy', function () {
    Binder.destroy();
  });

  return Keyboard;
}

function autoplay (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  var Autoplay = {
    /**
     * Initializes autoplaying and events.
     *
     * @return {Void}
     */
    mount: function mount() {
      this.start();

      if (Glide.settings.hoverpause) {
        this.bind();
      }
    },


    /**
     * Starts autoplaying in configured interval.
     *
     * @param {Boolean|Number} force Run autoplaying with passed interval regardless of `autoplay` settings
     * @return {Void}
     */
    start: function start() {
      var _this = this;

      if (Glide.settings.autoplay) {
        if (isUndefined(this._i)) {
          this._i = setInterval(function () {
            _this.stop();

            Components.Run.make('>');

            _this.start();
          }, this.time);
        }
      }
    },


    /**
     * Stops autorunning of the glide.
     *
     * @return {Void}
     */
    stop: function stop() {
      this._i = clearInterval(this._i);
    },


    /**
     * Stops autoplaying while mouse is over glide's area.
     *
     * @return {Void}
     */
    bind: function bind() {
      var _this2 = this;

      Binder.on('mouseover', Components.Html.root, function () {
        _this2.stop();
      });

      Binder.on('mouseout', Components.Html.root, function () {
        _this2.start();
      });
    },


    /**
     * Unbind mouseover events.
     *
     * @returns {Void}
     */
    unbind: function unbind() {
      Binder.off(['mouseover', 'mouseout'], Components.Html.root);
    }
  };

  define(Autoplay, 'time', {
    /**
     * Gets time period value for the autoplay interval. Prioritizes
     * times in `data-glide-autoplay` attrubutes over options.
     *
     * @return {Number}
     */
    get: function get() {
      var autoplay = Components.Html.slides[Glide.index].getAttribute('data-glide-autoplay');

      if (autoplay) {
        return toInt(autoplay);
      }

      return toInt(Glide.settings.autoplay);
    }
  });

  /**
   * Stop autoplaying and unbind events:
   * - on destroying, to clear defined interval
   * - on updating via API to reset interval that may changed
   */
  Events.on(['destroy', 'update'], function () {
    Autoplay.unbind();
  });

  /**
   * Stop autoplaying:
   * - before each run, to restart autoplaying
   * - on pausing via API
   * - on destroying, to clear defined interval
   * - while starting a swipe
   * - on updating via API to reset interval that may changed
   */
  Events.on(['run.before', 'pause', 'destroy', 'swipe.start', 'update'], function () {
    Autoplay.stop();
  });

  /**
   * Start autoplaying:
   * - after each run, to restart autoplaying
   * - on playing via API
   * - while ending a swipe
   */
  Events.on(['run.after', 'play', 'swipe.end'], function () {
    Autoplay.start();
  });

  /**
   * Remount autoplaying:
   * - on updating via API to reset interval that may changed
   */
  Events.on('update', function () {
    Autoplay.mount();
  });

  /**
   * Destroy a binder:
   * - on destroying glide instance to clearup listeners
   */
  Events.on('destroy', function () {
    Binder.destroy();
  });

  return Autoplay;
}

/**
 * Sorts keys of breakpoint object so they will be ordered from lower to bigger.
 *
 * @param {Object} points
 * @returns {Object}
 */
function sortBreakpoints(points) {
  if (isObject(points)) {
    return sortKeys(points);
  } else {
    warn('Breakpoints option must be an object');
  }

  return {};
}

function breakpoints (Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsBinder}
   */
  var Binder = new EventsBinder();

  /**
   * Holds reference to settings.
   *
   * @type {Object}
   */
  var settings = Glide.settings;

  /**
   * Holds reference to breakpoints object in settings. Sorts breakpoints
   * from smaller to larger. It is required in order to proper
   * matching currently active breakpoint settings.
   *
   * @type {Object}
   */
  var points = sortBreakpoints(settings.breakpoints);

  /**
   * Cache initial settings before overwritting.
   *
   * @type {Object}
   */
  var defaults = _extends({}, settings);

  var Breakpoints = {
    /**
     * Matches settings for currectly matching media breakpoint.
     *
     * @param {Object} points
     * @returns {Object}
     */
    match: function match(points) {
      if (typeof window.matchMedia !== 'undefined') {
        for (var point in points) {
          if (points.hasOwnProperty(point)) {
            if (window.matchMedia('(max-width: ' + point + 'px)').matches) {
              return points[point];
            }
          }
        }
      }

      return defaults;
    }
  };

  /**
   * Overwrite instance settings with currently matching breakpoint settings.
   * This happens right after component initialization.
   */
  _extends(settings, Breakpoints.match(points));

  /**
   * Update glide with settings of matched brekpoint:
   * - window resize to update slider
   */
  Binder.on('resize', window, throttle(function () {
    Glide.settings = mergeOptions(settings, Breakpoints.match(points));
  }, Glide.settings.throttle));

  /**
   * Resort and update default settings:
   * - on reinit via API, so breakpoint matching will be performed with options
   */
  Events.on('update', function () {
    points = sortBreakpoints(points);

    defaults = _extends({}, settings);
  });

  /**
   * Unbind resize listener:
   * - on destroying, to bring markup to its initial state
   */
  Events.on('destroy', function () {
    Binder.off('resize', window);
  });

  return Breakpoints;
}

var COMPONENTS = {
  Html: Html,
  Translate: Translate,
  Transition: Transition,
  Direction: Direction,
  Peek: Peek,
  Sizes: Sizes,
  Gaps: Gaps,
  Move: Move,
  Clones: Clones,
  Resize: Resize,
  Build: Build,
  Run: Run
};

var Glide$1 = function (_Core) {
  inherits(Glide$$1, _Core);

  function Glide$$1() {
    classCallCheck(this, Glide$$1);
    return possibleConstructorReturn(this, (Glide$$1.__proto__ || Object.getPrototypeOf(Glide$$1)).apply(this, arguments));
  }

  createClass(Glide$$1, [{
    key: 'mount',
    value: function mount() {
      var extensions = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      return get(Glide$$1.prototype.__proto__ || Object.getPrototypeOf(Glide$$1.prototype), 'mount', this).call(this, _extends({}, COMPONENTS, extensions));
    }
  }]);
  return Glide$$1;
}(Glide);

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Glide$1);



/***/ }),

/***/ "./common/js/EventgalleryTools.js":
/*!****************************************!*\
  !*** ./common/js/EventgalleryTools.js ***!
  \****************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Helpers */ "./common/js/Helpers.js");

window.Eventgallery = window.Eventgallery || {};

if (typeof eventgallery !== 'undefined') {
  Eventgallery.jQuery = eventgallery.jQuery;
}

Eventgallery.Tools = {};
Eventgallery.Tools.mergeObjects = _Helpers__WEBPACK_IMPORTED_MODULE_0__.mergeObjects;
Eventgallery.Tools.calcBorderWidth = _Helpers__WEBPACK_IMPORTED_MODULE_0__.calcBorderWidth;
Eventgallery.Tools.addUrlHashParameter = _Helpers__WEBPACK_IMPORTED_MODULE_0__.addUrlHashParameter;
Eventgallery.Tools.getUrlHashParameterValue = _Helpers__WEBPACK_IMPORTED_MODULE_0__.getUrlHashParameterValue;
Eventgallery.Tools.removeUrlHashParameter = _Helpers__WEBPACK_IMPORTED_MODULE_0__.removeUrlHashParameter;
Eventgallery.Tools.addUrlParameter = _Helpers__WEBPACK_IMPORTED_MODULE_0__.addUrlParameter;
Eventgallery.Tools.removeUrlParameter = _Helpers__WEBPACK_IMPORTED_MODULE_0__.removeUrlParameter;
Eventgallery.Tools.setCSSStyle = _Helpers__WEBPACK_IMPORTED_MODULE_0__.setCSSStyle;

/***/ }),

/***/ "./common/js/Helpers.js":
/*!******************************!*\
  !*** ./common/js/Helpers.js ***!
  \******************************/
/*! namespace exports */
/*! export addUrlHashParameter [provided] [no usage info] [missing usage info prevents renaming] */
/*! export addUrlParameter [provided] [no usage info] [missing usage info prevents renaming] */
/*! export calcBorderWidth [provided] [no usage info] [missing usage info prevents renaming] */
/*! export getParents [provided] [no usage info] [missing usage info prevents renaming] */
/*! export getUrlHashParameterValue [provided] [no usage info] [missing usage info prevents renaming] */
/*! export mergeObjects [provided] [no usage info] [missing usage info prevents renaming] */
/*! export removeElement [provided] [no usage info] [missing usage info prevents renaming] */
/*! export removeUrlHashParameter [provided] [no usage info] [missing usage info prevents renaming] */
/*! export removeUrlParameter [provided] [no usage info] [missing usage info prevents renaming] */
/*! export serializeForm [provided] [no usage info] [missing usage info prevents renaming] */
/*! export setCSSStyle [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "removeElement": () => /* binding */ removeElement,
/* harmony export */   "addUrlHashParameter": () => /* binding */ addUrlHashParameter,
/* harmony export */   "calcBorderWidth": () => /* binding */ calcBorderWidth,
/* harmony export */   "mergeObjects": () => /* binding */ mergeObjects,
/* harmony export */   "addUrlParameter": () => /* binding */ addUrlParameter,
/* harmony export */   "getUrlHashParameterValue": () => /* binding */ getUrlHashParameterValue,
/* harmony export */   "removeUrlHashParameter": () => /* binding */ removeUrlHashParameter,
/* harmony export */   "removeUrlParameter": () => /* binding */ removeUrlParameter,
/* harmony export */   "setCSSStyle": () => /* binding */ setCSSStyle,
/* harmony export */   "getParents": () => /* binding */ getParents,
/* harmony export */   "serializeForm": () => /* binding */ serializeForm
/* harmony export */ });
function removeElement(array, elm) {
  var index = array.indexOf(elm);

  if (index > -1) {
    array.splice(index, 1);
  }
}

function mergeObjects(defaults, options) {
  if (options === null || defaults === null) {
    return defaults;
  }

  for (var key in options) {
    defaults[key] = options[key];
  }

  return defaults;
}
/**
 * calculates the border of the given elements with the given properties
 */


function calcBorderWidth(elements, properties) {
  var sum = 0;

  for (var i = 0; i < elements.length; i++) {
    for (var j = 0; j < properties.length; j++) {
      var value = parseFloat(elements[i].css(properties[j]));

      if (!isNaN(value)) {
        sum += value;
      }
    }
  }

  return sum;
}

function addUrlHashParameter(initialUrl, key, value) {
  var url = removeUrlHashParameter(initialUrl, key),
      fragments = url.split('#'),
      urlpart = fragments[0],
      hashparts = fragments.length > 1 ? fragments[1].split("&") : [],
      result;
  hashparts.push(encodeURIComponent(key) + "=" + encodeURIComponent(value));

  if (hashparts.length > 0) {
    result = urlpart + '#' + hashparts.join('&');
  } else {
    result = urlpart;
  }

  return result;
}

function getUrlHashParameterValue(url, key) {
  var fragments = url.split('#'),
      hashparts = fragments.length > 1 ? fragments[1].split("&") : [],
      result;

  if (hashparts.length > 0) {
    var prefix = encodeURIComponent(key) + '=';

    for (var i = 0; i < hashparts.length; i++) {
      if (hashparts[i].indexOf(prefix, 0) === 0) {
        result = hashparts[i].replace(prefix, '');
      }
    }
  }

  return result;
}

function removeUrlHashParameter(url, key) {
  var fragments = url.split('#'),
      urlpart = fragments[0],
      hashparts = fragments.length > 1 ? fragments[1].split("&") : [],
      result;

  if (hashparts.length > 0) {
    var prefix = encodeURIComponent(key) + '=',
        newHashParts = [];

    for (var i = 0; i < hashparts.length; i++) {
      if (hashparts[i].indexOf(prefix, 0) === 0) {} else {
        newHashParts.push(hashparts[i]);
      }
    }

    hashparts = newHashParts;
  }

  if (hashparts.length > 0) {
    result = urlpart + '#' + hashparts.join('&');
  } else {
    result = urlpart;
  }

  return result;
}

function addUrlParameter(initialUrl, key, value) {
  var url = removeUrlParameter(initialUrl, key),
      fragments = url.split('#'),
      urlparts = fragments[0].split('?'),
      result;

  if (urlparts.length === 1) {
    result = urlparts[0] + '?' + encodeURIComponent(key) + "=" + encodeURIComponent(value);
  } else {
    result = urlparts.join('?') + '&' + encodeURIComponent(key) + "=" + encodeURIComponent(value);
  }

  if (fragments.length > 1) {
    return result + '#' + fragments[1];
  }

  return result;
}

function removeUrlParameter(url, key) {
  var fragments = url.split('#'),
      urlparts = fragments[0].split('?'),
      result;

  if (urlparts.length > 1) {
    var prefix = encodeURIComponent(key) + '=';
    var pars = urlparts[1].split('&');

    for (var i = 0; i < pars.length; i++) {
      if (pars[i].indexOf(prefix, 0) === 0) {
        pars.splice(i, 1);
      }
    }

    if (pars.length > 0) {
      result = urlparts[0] + '?' + pars.join('&');
    } else {
      result = urlparts[0];
    }
  } else {
    result = urlparts[0];
  }

  if (fragments.length > 1) {
    return result + '#' + fragments[1];
  }

  return result;
}

function setCSSStyle(nodes, style, value) {
  for (var i = 0; i < nodes.length; i++) {
    nodes[i].style[style] = value;
  }
}
/**
 *
 * @param node HTMLElement
 */


function getParents(node) {
  var parents = [];

  if (node === null) {
    return parents;
  }

  while (node.parentElement != null) {
    var parent = node.parentElement;
    parents.push(parent);
    node = parent;
  }

  return parents;
}
/*!
 * Serialize all form data into a query string
 * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
 * Modified to use any HTML element instead of a form element.
 * @param  {Node}   form The form container to serialize
 * @return {String}      The serialized form data
 */


var serializeForm = function serializeForm(form) {
  // Setup our serialized data
  var serialized = [];
  var inputElements = form.querySelectorAll('input,select,textarea'); // Loop through each field in the form

  for (var i = 0; i < inputElements.length; i++) {
    var field = inputElements[i]; // Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields

    if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue; // If a multi-select, get all selections

    if (field.type === 'select-multiple') {
      for (var n = 0; n < field.options.length; n++) {
        if (!field.options[n].selected) continue;
        serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[n].value));
      }
    } // Convert field data to a query string
    else if (field.type !== 'checkbox' && field.type !== 'radio' || field.checked) {
        serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value));
      }
  }

  return serialized.join('&');
};



/***/ }),

/***/ "./eventgallery.js":
/*!*************************!*\
  !*** ./eventgallery.js ***!
  \*************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.n, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var custom_event_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! custom-event-polyfill */ "./node_modules/custom-event-polyfill/polyfill.js");
/* harmony import */ var custom_event_polyfill__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(custom_event_polyfill__WEBPACK_IMPORTED_MODULE_0__);
//import "@babel/polyfill";


__webpack_require__(/*! ./common/js/EventgalleryTools.js */ "./common/js/EventgalleryTools.js");

__webpack_require__(/*! ./frontend/js/EventgalleryCart.js */ "./frontend/js/EventgalleryCart.js");

__webpack_require__(/*! ./frontend/js/EventgalleryBehavior.js */ "./frontend/js/EventgalleryBehavior.js");

__webpack_require__(/*! ./frontend/js/EventgalleryImage.js */ "./frontend/js/EventgalleryImage.js");

__webpack_require__(/*! ./frontend/js/EventgalleryRow.js */ "./frontend/js/EventgalleryRow.js");

__webpack_require__(/*! ./frontend/js/EventgalleryImageList.js */ "./frontend/js/EventgalleryImageList.js");

__webpack_require__(/*! ./frontend/js/EventgalleryCart.js */ "./frontend/js/EventgalleryCart.js");

__webpack_require__(/*! ./frontend/js/EventgalleryEventsList.js */ "./frontend/js/EventgalleryEventsList.js");

__webpack_require__(/*! ./frontend/js/EventgalleryEventsTiles.js */ "./frontend/js/EventgalleryEventsTiles.js");

__webpack_require__(/*! ./frontend/js/EventgalleryJSGallery2.js */ "./frontend/js/EventgalleryJSGallery2.js");

__webpack_require__(/*! ./frontend/js/EventgalleryLazyload.js */ "./frontend/js/EventgalleryLazyload.js");

__webpack_require__(/*! ./frontend/js/EventgallerySizeCalculator.js */ "./frontend/js/EventgallerySizeCalculator.js");

__webpack_require__(/*! ./frontend/js/EventgallerySocialShareButton.js */ "./frontend/js/EventgallerySocialShareButton.js");

__webpack_require__(/*! ./frontend/js/EventgallerySquareList.js */ "./frontend/js/EventgallerySquareList.js");

__webpack_require__(/*! ./frontend/js/EventgalleryTilesCollection.js */ "./frontend/js/EventgalleryTilesCollection.js");

__webpack_require__(/*! ./frontend/js/EventgalleryTouch.js */ "./frontend/js/EventgalleryTouch.js");

__webpack_require__(/*! ./frontend/js/EventgalleryGooglePhotosProcessor.js */ "./frontend/js/EventgalleryGooglePhotosProcessor.js");

__webpack_require__(/*! ./frontend/js/EventgalleryCheckout.js */ "./frontend/js/EventgalleryCheckout.js");

__webpack_require__(/*! ./frontend/js/Modules.js */ "./frontend/js/Modules.js");

__webpack_require__(/*! ./frontend/js/PhotoSwipeGallery.js */ "./frontend/js/PhotoSwipeGallery.js");

__webpack_require__(/*! ./frontend/js/PhotoSwipeGallerySlide.js */ "./frontend/js/PhotoSwipeGallerySlide.js");

__webpack_require__(/*! ./frontend/less/eventgallery.less */ "./frontend/less/eventgallery.less");

__webpack_require__(/*! ./frontend/less/font-awesome/font-awesome.less */ "./frontend/less/font-awesome/font-awesome.less");

__webpack_require__(/*! ./photoswipe/photoswipe.css */ "./photoswipe/photoswipe.css");

__webpack_require__(/*! ./photoswipe/default-skin/default-skin.css */ "./photoswipe/default-skin/default-skin.css"); // Required Core Stylesheet





/***/ }),

/***/ "./frontend/js/EventgalleryBehavior.js":
/*!*********************************************!*\
  !*** ./frontend/js/EventgalleryBehavior.js ***!
  \*********************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PhotoSwipeGallery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PhotoSwipeGallery */ "./frontend/js/PhotoSwipeGallery.js");
/* harmony import */ var _Overlay__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Overlay */ "./frontend/js/Overlay.js");
/* harmony import */ var _slider_SliderStarter__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./slider/SliderStarter */ "./frontend/js/slider/SliderStarter.js");
/* harmony import */ var _Polyfill__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Polyfill */ "./frontend/js/Polyfill.ts");
/* harmony import */ var _EventgalleryLazyload__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./EventgalleryLazyload */ "./frontend/js/EventgalleryLazyload.js");






(function (Eventgallery, jQuery) {
  "use strict";

  jQuery(document).ready(function () {
    /*
    * GRID LIST OF EVENTS
    */
    function triggerLazyLoading() {
      _EventgalleryLazyload__WEBPACK_IMPORTED_MODULE_4__.default.watchImages();
    }

    jQuery('.eventgallery-events-gridlist').each(function (index, container) {
      var $container = jQuery(container);
      var $thumbnails = $container.find('.event-thumbnails .event-thumbnail');
      var options = {
        rowHeightPercentage: 100,
        imagesetContainer: $container.find('.event-thumbnails').first(),
        imageset: $thumbnails,
        initComplete: function initComplete() {
          triggerLazyLoading();
        },
        resizeStart: function resizeStart() {},
        resizeComplete: function resizeComplete() {
          jQuery(window).trigger('scroll');
        }
      }; // initialize the imagelist

      if ($thumbnails.length > 0) {
        new Eventgallery.EventsList(options);
      }
    });
    /*
    * TILE LIST OF EVENTS
    */

    jQuery('.eventgallery-events-tiles-list').each(function (index, container) {
      var $container = jQuery(container);
      var options = {
        imagesetContainer: $container.find('.event-thumbnails').first(),
        imageset: $container.find('.event-thumbnail'),
        eventgalleryTilesCollection: null,
        initComplete: function initComplete() {
          triggerLazyLoading();
          var tilesOptions = {
            tiles: $container.find('.eventgallery-tiles .eventgallery-tile'),
            tilesContainer: $container.find('.eventgallery-tiles')
          };
          options.eventgalleryTilesCollection = new Eventgallery.TilesCollection(tilesOptions);
          options.eventgalleryTilesCollection.calculate(); // we need to recalculate the whole thing because it might happen that a font loads
          // and the size of a tile changes.

          window.addEventListener('load', function () {
            options.eventgalleryTilesCollection.calculate();
          });
        },
        resizeStart: function resizeStart() {},
        resizeComplete: function resizeComplete() {
          options.eventgalleryTilesCollection.calculate();
          jQuery(window).trigger('scroll');
        }
      }; // initialize the imagelist

      new Eventgallery.EventsTiles(options);
    });
    /*
    * TILES LIST OF IMAGES
    */

    jQuery('.eventgallery-event-tiles-list').each(function (index, container) {
      var $container = jQuery(container);
      var options = {
        imagesetContainer: $container.find('.event-thumbnails').first(),
        imageset: $container.find('.event-thumbnail'),
        adjustMode: 'width',
        eventgalleryTilesCollection: null,
        initComplete: function initComplete() {
          var tilesOptions = {
            tiles: $container.find('.eventgallery-tiles .eventgallery-tile'),
            tilesContainer: $container.find('.eventgallery-tiles')
          };
          options.eventgalleryTilesCollection = new Eventgallery.TilesCollection(tilesOptions);
          options.eventgalleryTilesCollection.calculate(); // we need to recalculate the whole thing because it might happen that a font loads
          // and the size of a tile changes.

          window.addEventListener('load', function () {
            options.eventgalleryTilesCollection.calculate();
          });
          triggerLazyLoading();
        },
        resizeStart: function resizeStart() {},
        resizeComplete: function resizeComplete() {
          options.eventgalleryTilesCollection.calculate();
          jQuery(window).trigger('scroll');
        }
      }; // initialize the imagelist

      new Eventgallery.EventsTiles(options);
    });
    /*
    * SIMPLE IMAGE LIST
    */

    jQuery('.eventgallery-event-gridlist').each(function (index, container) {
      var $container = jQuery(container);
      var options = {
        imagesetContainer: $container.find('.event-thumbnails').first(),
        imageset: $container.find('.event-thumbnail'),
        adjustMode: 'height',
        initComplete: function initComplete() {
          var gridOptions = {
            tiles: $container.find('.eventgallery-simplelist .eventgallery-simplelist-tile'),
            tilesContainer: $container.find('.eventgallery-simplelist'),
            thumbSelector: '.event-thumbnail',
            thumbContainerSelector: '.event-thumbnails'
          };
          triggerLazyLoading();
        },
        resizeStart: function resizeStart() {},
        resizeComplete: function resizeComplete() {
          jQuery(window).trigger('scroll');
        }
      }; // initialize the imagelist

      new Eventgallery.EventsTiles(options);
    });
    /*
    * IMAGE LIST
    */

    jQuery('.eventgallery-imagelist').each(function (index, imagesetContainer) {
      var $imagesetContainer = jQuery(imagesetContainer);
      var options = {
        rowHeight: $imagesetContainer.data('rowheight'),
        rowHeightJitter: $imagesetContainer.data('rowheightjitter'),
        firstImageRowHeight: $imagesetContainer.data('firstimagerowheight'),
        doFillLastRow: $imagesetContainer.data('dofilllastrow') === true,
        imagesetContainer: imagesetContainer,
        imageset: $imagesetContainer.find('.thumbnail'),
        initComplete: function initComplete() {
          triggerLazyLoading();
        },
        resizeStart: function resizeStart() {},
        resizeComplete: function resizeComplete() {
          jQuery(window).trigger('scroll');
        }
      }; // initialize the imagelist

      new Eventgallery.Imagelist(options);
    });
    /*
     * SQUARE SIZED LIST OF IMAGES
     */

    jQuery('.eventgallery-event-square-list').each(function (index, container) {
      var $container = jQuery(container);
      var options = {
        imagesetContainer: $container.find('.event-thumbnails').first(),
        imageset: $container.find('.event-thumbnail'),
        adjustMode: 'width',
        initComplete: function initComplete() {
          triggerLazyLoading();
        },
        resizeStart: function resizeStart() {},
        resizeComplete: function resizeComplete() {
          jQuery(window).trigger('scroll');
        }
      }; // initialize the imagelist

      new Eventgallery.SquareList(options);
    });
    /**
     * sets the radio button if one clicks in a table row.
     */

    jQuery('.eventgallery-imagetype-selection-row').click(function (e) {
      var $target = jQuery(e.target);
      $target.closest('tr').find('input').prop("checked", true);
    });
    jQuery(document).on('touchend click', '.eventgallery-cart-connector', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var link = jQuery(e.target);

      if (!link.attr('data-href')) {
        link = link.parent('SPAN');
      }

      window.location.href = link.attr('data-href');
    });
    /**
    * Lightbox init
     * @type {PhotoSwipeGallery}
     */

    Eventgallery.lightbox = new _PhotoSwipeGallery__WEBPACK_IMPORTED_MODULE_0__.default();
    Eventgallery.lightbox.initPhotoSwipe();
    /**
    * Single Image Page
     */

    jQuery('.singleimage-zoom').click(function (e) {
      e.preventDefault();
      jQuery('#bigimagelink').click();
    });
    /**
    * content overlay
     */

    jQuery('a[data-eventgallery-overlay]').each(function (item) {
      var contentId = this.getAttribute('href');
      jQuery(this).click(function (e) {
        var overlay = new _Overlay__WEBPACK_IMPORTED_MODULE_1__.default();
        overlay.openOverlay(document.getElementById(contentId.replace("#", "")).innerHTML);
      });
    });

    if (window.EventGalleryLightboxConfiguration && window.EventGalleryLightboxConfiguration.doPreventRightClick) {
      jQuery(document).on("contextmenu", 'a[data-eg-lightbox] img, img.pswp__img', function () {
        return false;
      });
    }

    var googlePhotosProcessor = new Eventgallery.GooglePhotosProcessor();
    document.dispatchEvent(_Polyfill__WEBPACK_IMPORTED_MODULE_3__.default.createNewEvent('eventgallery-images-added'));
    var sliderElements = document.querySelectorAll('div[data-slider="1"]');

    var _loop = function _loop(i) {
      var sliderStarter = new _slider_SliderStarter__WEBPACK_IMPORTED_MODULE_2__.default(sliderElements[i]);
      var timer = null;
      sliderStarter.start();
      window.addEventListener("resize", function () {
        if (timer != null) {
          clearTimeout(timer);
        }

        timer = setTimeout(function () {
          return sliderStarter.start();
        }, 1000);
      }, false);
    };

    for (var i = 0; i < sliderElements.length; i++) {
      _loop(i);
    }
  }); //end domready
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryCart.js":
/*!*****************************************!*\
  !*** ./frontend/js/EventgalleryCart.js ***!
  \*****************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Overlay__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Overlay */ "./frontend/js/Overlay.js");
/* harmony import */ var _Polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Polyfill */ "./frontend/js/Polyfill.ts");



(function (Eventgallery, jQuery) {
  Eventgallery.Cart = function (newOptions) {
    this.cart = [];
    this.isMultiline = false;
    this.options = {
      buttonShowType: 'block',
      emptyCartSelector: '.eventgallery-cart-empty',
      cartSelector: '.eventgallery-ajaxcart',
      cartItemContainerSelector: '.cart-items-container',
      cartItemsSelector: '.eventgallery-ajaxcart .cart-items',
      cartItemSelector: '.eventgallery-ajaxcart .cart-items .cart-item',
      cartCountSelector: '.itemscount',
      buttonDownSelector: '.toggle-down',
      buttonUpSelector: '.toggle-up',
      cartItemsMinHeight: null,
      removeUrl: "",
      add2cartUrl: "",
      getCartUrl: "",
      removeLinkTitle: "Remove"
    };
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
    this.initialize();
  };

  Eventgallery.Cart.prototype.slideUp = function () {
    jQuery(this.options.cartItemContainerSelector).animate({
      height: this.options.cartItemsMinHeight
    });
    jQuery(this.options.buttonUpSelector).css('display', 'none');

    if (this.isMultiline) {
      jQuery(this.options.buttonDownSelector).css('display', this.options.buttonShowType);
    } else {
      jQuery(this.options.buttonDownSelector).css('display', 'none');
    }
  };

  Eventgallery.Cart.prototype.slideDown = function () {
    jQuery(this.options.cartItemContainerSelector).animate({
      height: jQuery(this.options.cartItemsSelector).height()
    });
    jQuery(this.options.buttonDownSelector).css('display', 'none');
    jQuery(this.options.buttonUpSelector).css('display', this.options.buttonShowType);
  };

  Eventgallery.Cart.prototype.initialize = function () {
    jQuery(this.options.buttonDownSelector).click(jQuery.proxy(function (event) {
      event.preventDefault();
      this.slideDown();
    }, this));
    jQuery(this.options.buttonUpSelector).click(jQuery.proxy(function (event) {
      event.preventDefault();
      this.slideUp();
    }, this));
    var $document = jQuery(document);
    $document.off('change', '.eventgallery-cartquantity');
    $document.on('change', '.eventgallery-cartquantity', jQuery.proxy(this.updateQuantity, this));
    $document.off('click', '.eventgallery-openAdd2cart');
    $document.on('click', '.eventgallery-openAdd2cart', jQuery.proxy(this.openOverlay, this));
    $document.off('touchend click', '.eventgallery-opencart');
    $document.on('touchend click', '.eventgallery-opencart', jQuery.proxy(this.openCart, this));
    $document.off('touchend click', '.eventgallery-qtyplus');
    $document.on('touchend click', '.eventgallery-qtyplus', jQuery.proxy(this.quantityPlus, this));
    $document.off('touchend click', '.eventgallery-qtyminus');
    $document.on('touchend click', '.eventgallery-qtyminus', jQuery.proxy(this.quantityMinus, this));
    $document.off('touchend click', '.eventgallery-removeFromCart');
    $document.on('touchend click', '.eventgallery-removeFromCart', jQuery.proxy(this.removeFromCart, this));
    $document.on('updatecartlinks', jQuery.proxy(function (event) {
      this.populateCart(true);
    }, this));
    $document.on('updatecart', jQuery.proxy(function (event, cart) {
      this.cart = cart;
      this.populateCart(false);
    }, this));
    this.updateCart();
  };

  Eventgallery.Cart.prototype.openOverlay = function (e) {
    e.preventDefault();
    e.stopPropagation();
    var link = jQuery(e.target);

    if (!link.attr('data-id')) {
      link = link.parent('[data-id]');
    }

    var overlay = new _Overlay__WEBPACK_IMPORTED_MODULE_0__.default();
    overlay.openOverlay(EventGalleryCartConfiguration.add2carturl + '&' + link.attr('data-id'));
    return false;
  };

  Eventgallery.Cart.prototype.openCart = function (e) {
    var $button;

    if (e.target.tagName !== 'BUTTON') {
      $button = jQuery(e.target).parent('button');
    } else {
      $button = jQuery(e.target);
    }

    e.preventDefault();
    window.location.href = $button.attr('data-href');
  };

  Eventgallery.Cart.prototype.updateCartItemContainer = function () {
    // detect multiple rows
    this.isMultiline = false;
    var y = -1;
    var currentObject = this;
    jQuery(this.options.cartItemSelector).each(function () {
      var posY = jQuery(this).position().top;

      if (y < 0) {
        y = posY;
      } else if (y != posY) {
        currentObject.isMultiline = true;
      }
    });

    if (this.isMultiline) {
      // prevent showing the wrong button. Basically this is an inital action if a second row is created.
      var down = jQuery(this.options.buttonDownSelector);
      var up = jQuery(this.options.buttonUpSelector);

      if (down.css('display') == 'none' && up.css('display') == 'none') {
        down.css('display', this.options.buttonShowType);
      } else {
        // update if a third or more row is created
        if (up.css('display') != 'none') {
          // timeout to avoid any size issues because of a slow browser
          setTimeout(jQuery.proxy(function () {
            this.slideDown();
          }, this), 1000);
        }
      }
    } else {
      this.slideUp();
    }
  };

  Eventgallery.Cart.prototype.populateCart = function (linksOnly) {
    if (this.cart.length === 0) {
      jQuery(this.options.cartSelector).slideUp();
      jQuery(this.options.emptyCartSelector).slideDown();
    } else {
      jQuery(this.options.cartSelector).slideDown();
      jQuery(this.options.emptyCartSelector).slideUp();
    } // define where all the cart html items are located


    var cartHTML = jQuery(this.options.cartItemsSelector);

    if (cartHTML === null) {
      return;
    } // clear the html showing the current cart


    if (!linksOnly) {
      cartHTML.html("");
    } // reset cart button icons


    jQuery('.eventgallery-add2cart i.egfa').addClass('egfa-cart-plus').removeClass('egfa-shopping-cart');

    for (var i = this.cart.length - 1; i >= 0; i--) {
      //create the id. It's always folder=foo&file=bar
      var id = 'folder=' + encodeURIComponent(this.cart[i].folder) + '&file=' + encodeURIComponent(this.cart[i].file); //add the item to the cart. Currently we simple refresh the whole cart.

      if (!linksOnly) {
        cartHTML.html(cartHTML.html() + '<div class="cart-item"><span class="badge badge-pill badge-info">' + this.cart[i].count + '</span>' + this.cart[i].imagetag + '<a href="#" title="' + this.options.removeLinkTitle + '" class="button-removeFromCart eventgallery-removeFromCart" data-id="lineitemid=' + this.cart[i].lineitemid + '">' + '<i class="egfa egfa-2x egfa-remove"></i>' + '</a></div>');
      } // mark the add2cart link to show the item is already in the cart


      jQuery('.eventgallery-add2cart[data-id*=\'' + id + '\'] i.egfa').addClass('egfa-shopping-cart').removeClass('egfa-cart-plus');
    }

    if (!linksOnly) {
      cartHTML.html(cartHTML.html() + '<div style="clear:both"></div>');

      if (null === this.options.cartItemsMinHeight) {
        this.options.cartItemsMinHeight = jQuery(this.options.cartItemContainerSelector).height();
      }

      this.updateCartItemContainer();
    }

    jQuery('.itemscount').html(this.cart.length);

    if (Eventgallery !== undefined && Eventgallery.lightbox !== undefined) {
      Eventgallery.lightbox.reload();
    } // tigger the loading of Google Photos images for example.


    document.dispatchEvent(_Polyfill__WEBPACK_IMPORTED_MODULE_1__.default.createNewEvent('eventgallery-images-added'));
  };

  Eventgallery.Cart.prototype.updateCart = function () {
    jQuery.getJSON(this.options.getCartUrl, {
      json: 'yes'
    }, function (data) {
      if (data !== undefined) {
        jQuery(document).trigger('updatecart', [data]);
      }
    });
  };

  Eventgallery.Cart.prototype.removeFromCart = function (event) {
    return this.doRequest(event, this.options.removeUrl);
  };

  Eventgallery.Cart.prototype.updateQuantity = function (event) {
    var $inputFild = jQuery(event.target),
        imagetypeid = $inputFild.data('imagetypeid'),
        quantity = parseInt($inputFild.val()),
        data = $inputFild.data('id');
    event.preventDefault();
    data = data + '&quantity=' + quantity;
    return this.doRequest(event, this.options.add2cartUrl, data);
  };

  Eventgallery.Cart.prototype.quantityPlus = function (e) {
    e.preventDefault();
    var fieldName = jQuery(e.target).attr('field'),
        inputField = jQuery('input[name=' + fieldName + ']'),
        currentVal = parseInt(inputField.val());

    if (!isNaN(currentVal)) {
      var maxOrderQuantity = inputField.data('maxorderquantity');

      if (maxOrderQuantity === 0 || inputField.val() < maxOrderQuantity) {
        inputField.val(currentVal + 1);
      }

      inputField.change();
    } else {
      inputField.val(0);
    }
  };

  Eventgallery.Cart.prototype.quantityMinus = function (e) {
    e.preventDefault();
    var fieldName = jQuery(e.target).attr('field'),
        inputField = jQuery('input[name=' + fieldName + ']'),
        currentVal = parseInt(inputField.val());

    if (!isNaN(currentVal) && currentVal > 0) {
      inputField.val(currentVal - 1).change();
    } else {
      inputField.val(0);
    }
  };

  Eventgallery.Cart.prototype.doRequest = function (event, url, data) {
    event.preventDefault();
    var linkElement = jQuery(event.target);

    if (!linkElement.attr('data-id')) {
      linkElement = linkElement.parent('[data-id]');
    }

    var iconElement = linkElement.children('i');

    if (data === undefined) {
      data = linkElement.attr('data-id');
    }

    iconElement.removeClass("egfa-cart-plus").removeClass("egfa-shopping-cart").addClass('egfa-spin egfa-gear');
    jQuery.getJSON(url, data, function (data) {
      if (data !== undefined) {
        jQuery(document).trigger('updatecart', [data]);
      }

      iconElement.removeClass('egfa-spin').removeClass('egfa-gear').addClass('');
    });
    return true;
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryCheckout.js":
/*!*********************************************!*\
  !*** ./frontend/js/EventgalleryCheckout.js ***!
  \*********************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function () {
  function switchStates(e) {
    var target = e.target;
    var id = target.id;
    var countryId = target.options[target.selectedIndex].value;
    var stateId = id.replace('_country', '_state');
    var stateField = document.getElementById(stateId);

    if (!stateField) {
      return;
    }

    var optGroups = stateField.querySelectorAll('optgroup');

    for (var i = 0; i < optGroups.length; i++) {
      console.log(i);
      var optGroup = optGroups[i];

      if (optGroup.id === stateId + '_' + countryId || optGroup.id === stateId + '_nocountry') {
        optGroup.style.display = 'block';
      } else {
        optGroup.style.display = 'none';
      }
    }

    var selectedStateOption = stateField.options[stateField.selectedIndex];

    if (selectedStateOption.parentElement.style.display === 'none') {
      stateField.selectedIndex = 0;
    }
  }

  document.addEventListener('checkout-address-country-changed', function (e) {
    console.log(e);
    switchStates(e);
  });
})();

/***/ }),

/***/ "./frontend/js/EventgalleryEventsList.js":
/*!***********************************************!*\
  !*** ./frontend/js/EventgalleryEventsList.js ***!
  \***********************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  Eventgallery.EventsList = function (newOptions) {
    Eventgallery.Imagelist.call(this, newOptions);
  };

  Eventgallery.EventsList.prototype = new Eventgallery.Imagelist();
  Eventgallery.EventsList.prototype.constructor = Eventgallery.EventsList;

  Eventgallery.EventsList.prototype.processList = function () {
    /* processes the image list*/
    var width = this.width;
    var currentObject = this;
    jQuery.each(this.images, function () {
      var height = Math.ceil(width * currentObject.options.rowHeightPercentage / 100);
      this.setSize(width, height);
    });
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryEventsTiles.js":
/*!************************************************!*\
  !*** ./frontend/js/EventgalleryEventsTiles.js ***!
  \************************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  /* processes a list of images and tries to resize separately*/
  Eventgallery.EventsTiles = function (newOptions) {
    Eventgallery.Imagelist.call(this, newOptions);
  };

  Eventgallery.EventsTiles.prototype = new Eventgallery.Imagelist();
  Eventgallery.EventsTiles.prototype.constructor = Eventgallery.EventsTiles;

  Eventgallery.EventsTiles.prototype.processList = function () {
    var width = this.width;
    var currentObject = this;
    jQuery.each(this.images, function () {
      var newHeight = Math.round(this.height / this.width * width);
      var newWidth = width;

      if (currentObject.options.adjustMode == "height" && this.height > this.width) {
        newHeight = width;
        newWidth = Math.round(this.width / this.height * newHeight);
      }

      this.setSize(newWidth, newHeight);
    });
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryGooglePhotosProcessor.js":
/*!**********************************************************!*\
  !*** ./frontend/js/EventgalleryGooglePhotosProcessor.js ***!
  \**********************************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _URLHelper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./URLHelper */ "./frontend/js/URLHelper.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



(function (Eventgallery) {
  var LOADING_MATCHER = 'gp.svg';
  var MARKER_IMAGE_IS_IN_PROGRESS_ATTRIBUTE = 'data-eg-gp-processing';

  Eventgallery.GooglePhotosProcessor = /*#__PURE__*/function () {
    function _class() {
      var _this = this;

      _classCallCheck(this, _class);

      this.albumUrl = "";
      this.albumsUrl = ""; // noinspection JSUnresolvedVariable

      if (window.EventGalleryGooglePhotosConfiguration) {
        this.albumUrl = window.EventGalleryGooglePhotosConfiguration.albumUrl;
        this.albumsUrl = window.EventGalleryGooglePhotosConfiguration.albumsUrl;
      }

      this.imageAddedCallback = function () {
        return _this.processImages();
      };

      document.addEventListener("eventgallery-images-added", this.imageAddedCallback, true);
    }

    _createClass(_class, [{
      key: "destroy",
      value: function destroy() {
        document.removeEventListener("eventgallery-images-added", this.imageAddedCallback, true);
      } // noinspection JSUnusedGlobalSymbols

    }, {
      key: "processImages",
      value: function processImages() {
        var albums = this._groupByAlbum(this._collectHTMLElements());

        this._markImagesAsInProgress(albums);

        this._getMainImageDataFromServer(albums);
      } // noinspection JSMethodCanBeStatic

      /**
       * Grabs IMG tag items from the DOM for Google Photos image placeholder.
       *
       * @returns <Element>[]
       * @private
       */

    }, {
      key: "_collectHTMLElements",
      value: function _collectHTMLElements() {
        var htmlCollection = document.getElementsByTagName('IMG');

        var foundImageHTMLElements =
        /** @type {HTMLElement} */
        _toConsumableArray(htmlCollection);

        var result = foundImageHTMLElements.filter(function (img) {
          var backgroundImage = img.style.backgroundImage;
          var dataSrc = img.getAttribute('data-src');
          var src = img.src;

          if (img.getAttribute(MARKER_IMAGE_IS_IN_PROGRESS_ATTRIBUTE) === '1') {
            return false;
          }

          return backgroundImage && backgroundImage.indexOf(LOADING_MATCHER) > 0 || dataSrc && dataSrc.indexOf(LOADING_MATCHER) > 0 || src && src.indexOf(LOADING_MATCHER) > 0;
        });
        htmlCollection = document.getElementsByTagName('A');

        var foundLinkHTMLElements =
        /** @type {HTMLElement} */
        _toConsumableArray(htmlCollection);

        result = result.concat(foundLinkHTMLElements.filter(function (a) {
          var dataSrc = a.getAttribute('data-src');
          var rel = a.getAttribute('rel');
          var href = a.getAttribute('href');

          if (a.getAttribute(MARKER_IMAGE_IS_IN_PROGRESS_ATTRIBUTE) === '1') {
            return false;
          }

          return href && href.indexOf(LOADING_MATCHER) > 0 || dataSrc && dataSrc.indexOf(LOADING_MATCHER) > 0 || rel && rel.indexOf(LOADING_MATCHER) > 0;
        }));
        return result;
      }
      /**
       *
       * @param albums {Map<any, any>}
       * @private
       */

    }, {
      key: "_markImagesAsInProgress",
      value: function _markImagesAsInProgress(albums) {
        var _iterator = _createForOfIteratorHelper(albums),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var _step$value = _slicedToArray(_step.value, 2),
                foldername = _step$value[0],
                album = _step$value[1];

            /**
             * @var ParsedHTMLElement parsedHTMLElement
             */
            album.forEach(function (parsedHTMLElement) {
              parsedHTMLElement.getHTMLElement().setAttribute(MARKER_IMAGE_IS_IN_PROGRESS_ATTRIBUTE, 1);
            });
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }
      }
      /**
       * sorts all found images into a map: key=folder, value=array of
       *
       * @param htmlElements
       * @returns {Map<any, any>}
       * @private
       */

    }, {
      key: "_groupByAlbum",
      value: function _groupByAlbum(htmlElements) {
        var _this2 = this;

        var albums = new Map();
        htmlElements.forEach(function (imageHTMLElement) {
          var parsedHTMLElement = _this2._parseHTMLElement(imageHTMLElement);

          parsedHTMLElement.updateParameters();
          var folder = parsedHTMLElement.parameters.get('folder');

          if (!albums.get(folder)) {
            albums.set(folder, []);
          }

          albums.get(folder).push(parsedHTMLElement);
        });
        return albums;
      } // noinspection JSMethodCanBeStatic

      /**
       *
       * @param htmlElement
       * @returns {ParsedHTMLElement}
       * @private
       */

    }, {
      key: "_parseHTMLElement",
      value: function _parseHTMLElement(htmlElement) {
        if (htmlElement.tagName === 'IMG') {
          return new ParsedImageHTMLElement(htmlElement);
        }

        return new ParsedLinkHTMLElement(htmlElement);
      }
      /**
       * starts several requests to the server to determine
       *
       * @param albums
       * @private
       */

    }, {
      key: "_getAlbumDataFromServer",
      value: function _getAlbumDataFromServer(albums) {
        var _iterator2 = _createForOfIteratorHelper(albums),
            _step2;

        try {
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            var _step2$value = _slicedToArray(_step2.value, 2),
                foldername = _step2$value[0],
                album = _step2$value[1];

            this._doAlbumRequest(foldername, album);
          }
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
      }
    }, {
      key: "_doAlbumRequest",
      value: function _doAlbumRequest(foldername, album) {
        var _this3 = this;

        if (!this.albumUrl) return;
        fetch(this.albumUrl + '&folder=' + foldername).then(function (response) {
          return response.json();
        }).then(function (data) {
          return _this3._processAlbumResult(album, data);
        });
      }
    }, {
      key: "_processAlbumResult",
      value: function _processAlbumResult(album, data) {
        this._replaceImages(album, data);
      }
    }, {
      key: "_getMainImageDataFromServer",
      value: function _getMainImageDataFromServer(albums) {
        var albumsWithMainImagesOnly = this._filterForAlbumsWithMainImageOnly(albums);

        if (albumsWithMainImagesOnly.size > 0) {
          this._doAlbumsRequest(albumsWithMainImagesOnly, albums);

          var _iterator3 = _createForOfIteratorHelper(albumsWithMainImagesOnly),
              _step3;

          try {
            for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
              var _step3$value = _slicedToArray(_step3.value, 2),
                  foldername = _step3$value[0],
                  album = _step3$value[1];

              albums["delete"](foldername);
            }
          } catch (err) {
            _iterator3.e(err);
          } finally {
            _iterator3.f();
          }
        }

        this._getAlbumDataFromServer(albums);
      }
    }, {
      key: "_doAlbumsRequest",
      value: function _doAlbumsRequest(albumsWithMainImagesOnly, albums) {
        var _this4 = this;

        if (!this.albumsUrl) return;
        fetch(this.albumsUrl).then(function (response) {
          return response.json();
        }).then(function (data) {
          return _this4._processAlbumsResult(albumsWithMainImagesOnly, albums, data);
        });
      }
    }, {
      key: "_processAlbumsResult",
      value: function _processAlbumsResult(albumsWithMainImagesOnly, albums, data) {
        var _iterator4 = _createForOfIteratorHelper(albumsWithMainImagesOnly),
            _step4;

        try {
          for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
            var _step4$value = _slicedToArray(_step4.value, 2),
                key = _step4$value[0],
                album = _step4$value[1];

            this._replaceImages(album, data[key]);
          }
        } catch (err) {
          _iterator4.e(err);
        } finally {
          _iterator4.f();
        }

        this._getAlbumDataFromServer(albums);
      } // noinspection JSMethodCanBeStatic

    }, {
      key: "_filterForAlbumsWithMainImageOnly",
      value: function _filterForAlbumsWithMainImageOnly(albums) {
        var newAlbums = new Map();

        var _iterator5 = _createForOfIteratorHelper(albums),
            _step5;

        try {
          for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
            var _step5$value = _slicedToArray(_step5.value, 2),
                key = _step5$value[0],
                album = _step5$value[1];

            var mainImages = album.filter(function (image) {
              return image.isMainImage();
            });

            if (mainImages.length > 0 && mainImages.length === album.length) {
              newAlbums.set(key, album);
            }
          }
        } catch (err) {
          _iterator5.e(err);
        } finally {
          _iterator5.f();
        }

        return newAlbums;
      }
    }, {
      key: "_replaceImages",
      value: function _replaceImages(album, serverResult) {
        if (album === undefined || serverResult === undefined) {
          return;
        }

        album.forEach(function (parsedImageHTMLElement) {
          var imageUrl = serverResult[parsedImageHTMLElement.getFile()];

          if (imageUrl === undefined) {
            return false;
          }

          parsedImageHTMLElement.updateParameters();
          parsedImageHTMLElement.replaceElementLinks(imageUrl);
          parsedImageHTMLElement.getHTMLElement().setAttribute(MARKER_IMAGE_IS_IN_PROGRESS_ATTRIBUTE, 0);
        });

        if (Eventgallery.lightbox) {
          if (Eventgallery.lightbox.isOpen()) {
            var link = Eventgallery.lightbox.getCurrentSlide().thumbnailContainer;

            Eventgallery.lightbox._gallery.close();

            setTimeout(function () {
              return link.click();
            }, 500);
          }
        }
      }
    }]);

    return _class;
  }();

  var ParsedHTMLElement = /*#__PURE__*/function () {
    function ParsedHTMLElement(htmlElement) {
      _classCallCheck(this, ParsedHTMLElement);

      this.htmlElement = htmlElement;
      this.parameters = null;
      this.attributeNames = new Set();
      this.styleAttributeNames = new Set();
    }

    _createClass(ParsedHTMLElement, [{
      key: "updateParametersWithUrl",
      value: function updateParametersWithUrl(url) {
        var parameterString = url.substring(url.indexOf('#') + 1);
        this.parameters = _URLHelper__WEBPACK_IMPORTED_MODULE_0__.default.parseURLParameter(parameterString);
      }
    }, {
      key: "updateParameters",
      value: function updateParameters() {
        var _iterator6 = _createForOfIteratorHelper(this.attributeNames),
            _step6;

        try {
          for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
            var n = _step6.value;
            var url = this.getHTMLElement().getAttribute(n);

            if (url && url.indexOf(LOADING_MATCHER) > 0) {
              this.updateParametersWithUrl(url);
              return;
            }
          }
        } catch (err) {
          _iterator6.e(err);
        } finally {
          _iterator6.f();
        }

        var _iterator7 = _createForOfIteratorHelper(this.styleAttributeNames),
            _step7;

        try {
          for (_iterator7.s(); !(_step7 = _iterator7.n()).done;) {
            var _n2 = _step7.value;

            var _url = _URLHelper__WEBPACK_IMPORTED_MODULE_0__.default.extractBackgroudUrl(this.getHTMLElement().style[_n2]);

            if (_url && _url.indexOf(LOADING_MATCHER) > 0) {
              this.updateParametersWithUrl(_url);
              return;
            }
          }
        } catch (err) {
          _iterator7.e(err);
        } finally {
          _iterator7.f();
        }
      }
    }, {
      key: "replaceElementLinks",
      value: function replaceElementLinks(imageUrl) {
        var _iterator8 = _createForOfIteratorHelper(this.attributeNames),
            _step8;

        try {
          for (_iterator8.s(); !(_step8 = _iterator8.n()).done;) {
            var n = _step8.value;
            var url = this.getHTMLElement().getAttribute(n);

            if (url && url.indexOf(LOADING_MATCHER) > 0) {
              this.getHTMLElement().setAttribute(n, this.getImageUrl(imageUrl, this.getWidth(url)));
            }
          }
        } catch (err) {
          _iterator8.e(err);
        } finally {
          _iterator8.f();
        }

        var _iterator9 = _createForOfIteratorHelper(this.styleAttributeNames),
            _step9;

        try {
          for (_iterator9.s(); !(_step9 = _iterator9.n()).done;) {
            var _n3 = _step9.value;

            var _url2 = _URLHelper__WEBPACK_IMPORTED_MODULE_0__.default.extractBackgroudUrl(this.getHTMLElement().style[_n3]);

            if (_url2 && _url2.indexOf(LOADING_MATCHER) > 0) {
              this.getHTMLElement().style[_n3] = 'url(' + this.getImageUrl(imageUrl, this.getWidth(_url2)) + ')';
            }
          }
        } catch (err) {
          _iterator9.e(err);
        } finally {
          _iterator9.f();
        }
      }
    }, {
      key: "getHTMLElement",
      value: function getHTMLElement() {
        return this.htmlElement;
      }
    }, {
      key: "getFolder",
      value: function getFolder() {
        return this.parameters.get('folder');
      }
    }, {
      key: "getFile",
      value: function getFile() {
        return this.parameters.get('file');
      }
    }, {
      key: "getWidth",
      value: function getWidth(url) {
        return _URLHelper__WEBPACK_IMPORTED_MODULE_0__.default.parseURLParameter(url).get('width');
      }
    }, {
      key: "getImageUrl",
      value: function getImageUrl(imageUrl, width) {
        return imageUrl + '=w' + width;
      }
    }, {
      key: "isMainImage",
      value: function isMainImage() {
        return this.parameters.get('m') === '1';
      }
    }]);

    return ParsedHTMLElement;
  }();

  var ParsedLinkHTMLElement = /*#__PURE__*/function (_ParsedHTMLElement) {
    _inherits(ParsedLinkHTMLElement, _ParsedHTMLElement);

    var _super = _createSuper(ParsedLinkHTMLElement);

    function ParsedLinkHTMLElement(htmlElement) {
      var _this5;

      _classCallCheck(this, ParsedLinkHTMLElement);

      _this5 = _super.call(this, htmlElement);
      _this5.attributeNames = new Set(['href', 'data-src', 'rel']);
      return _this5;
    }

    return ParsedLinkHTMLElement;
  }(ParsedHTMLElement);

  var ParsedImageHTMLElement = /*#__PURE__*/function (_ParsedHTMLElement2) {
    _inherits(ParsedImageHTMLElement, _ParsedHTMLElement2);

    var _super2 = _createSuper(ParsedImageHTMLElement);

    function ParsedImageHTMLElement(htmlElement) {
      var _this6;

      _classCallCheck(this, ParsedImageHTMLElement);

      _this6 = _super2.call(this, htmlElement);
      _this6.attributeNames = new Set(['src', 'data-src']);
      _this6.styleAttributeNames = new Set(['backgroundImage']);
      return _this6;
    }

    return ParsedImageHTMLElement;
  }(ParsedHTMLElement);
})(Eventgallery);

/***/ }),

/***/ "./frontend/js/EventgalleryImage.js":
/*!******************************************!*\
  !*** ./frontend/js/EventgalleryImage.js ***!
  \******************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  /*
   Class to manage an image. This can be the img tag or a container. It has to manage glue itself.
   */
  Eventgallery.Image = function (image, index, newOptions) {
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
    this.tag = jQuery(image);
    this.index = index;
    this.calculatedWidth = 0;
    this.calcSize();
  };

  Eventgallery.Image.prototype.calcSize = function () {
    // glue includes everything but the image width/heigt: margin, padding, border
    var image = this.tag.find('img').first();

    if (image.length === 0) {
      return;
    }

    var elements = [this.tag, image];
    this.glueLeft = Eventgallery.Tools.calcBorderWidth(elements, ['padding-left', 'margin-left', 'border-left-width']);
    this.glueRight = Eventgallery.Tools.calcBorderWidth(elements, ['padding-right', 'margin-right', 'border-right-width']);
    this.glueTop = Eventgallery.Tools.calcBorderWidth(elements, ['padding-top', 'margin-top', 'border-top-width']);
    this.glueBottom = Eventgallery.Tools.calcBorderWidth(elements, ['padding-bottom', 'margin-bottom', 'border-bottom-width']); // get image size from data- attributes

    this.width = image.data("width");
    this.height = image.data("height"); // fallback of data- attributes are not there

    if (this.width === undefined) {
      this.width = this.tag.width() - this.glueLeft - this.glueRight;
    }

    if (this.height === undefined) {
      this.height = this.tag.height() - this.glueTop - this.glueBottom;
    }
  };
  /**
   * calculates the height of that image container. This includes the image and the gap on top/bottom
   *
   * @returns float
   */


  Eventgallery.Image.prototype.getImageTagHeight = function () {
    return parseFloat(window.getComputedStyle(this.tag[0]).height) + this.glueTop + this.glueBottom;
  };

  Eventgallery.Image.prototype.setSize = function (width, height) {
    var isFlickr = false;
    var newWidth = width - this.glueLeft - this.glueRight;
    var newHeight = height - this.glueTop - this.glueBottom;
    var ratio = this.width / this.height; //console.log("the size of the image should be: "+width+"x"+height+" so I have to set it to: "+newWidth+"x"+newHeight);
    //adjust background images

    var image = this.tag.find('img');

    if (image.length === 0) {
      return;
    }

    var sizeCalculator = new Eventgallery.SizeCalculator(); // set a new background image

    var backgroundImageStyle = image.css('background-image');
    var dataSrc = image.attr('data-src');

    if (!dataSrc) {
      dataSrc = "";
    }

    var secret = image.data('secret');

    if (secret !== undefined) {
      var secret_o = image.data('secret_o'),
          secret_h = image.data('secret_h'),
          secret_k = image.data('secret_k'),
          farm = image.data('farm'),
          server = image.data('server'),
          id = image.data('id');
      var imageUrl = sizeCalculator.getFlickrURL(farm, server, secret, secret_h, secret_k, secret_o, id, newWidth, newHeight, this.width, this.height);

      if (backgroundImageStyle !== 'none') {
        backgroundImageStyle = "url('" + imageUrl + "')";
      }

      dataSrc = imageUrl;
      isFlickr = true;
    } else {
      var googleWidth = sizeCalculator.getSize(newWidth, newHeight, ratio);
      backgroundImageStyle = sizeCalculator.adjustImageURL(backgroundImageStyle, googleWidth);
      dataSrc = sizeCalculator.adjustImageURL(dataSrc, googleWidth);
    }

    image.css('background-image', backgroundImageStyle);
    image.attr('data-src', dataSrc);
    image.css('display', 'block');
    image.css('margin', 'auto'); // IE8 fix: check the width/height first

    if (newWidth > 0) {
      image.css('width', newWidth);
    }

    if (newHeight > 0) {
      image.css('height', newHeight);
    }
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryImageList.js":
/*!**********************************************!*\
  !*** ./frontend/js/EventgalleryImageList.js ***!
  \**********************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  Eventgallery.Imagelist = function (newOptions) {
    this.options = {
      rowHeightPercentage: 100,
      rowHeight: 150,
      rowHeightJitter: 0,
      minImageWidth: 150,
      // resize the last image to full width
      doFillLastRow: false,
      // the object where we try to get the width from
      imagesetContainer: null,
      // the object containing all the images elements. Usually they are retieved with a selector like '.imagelist a',
      imageset: null,
      firstImageRowHeight: 2,
      initComplete: function initComplete() {},
      resizeStart: function resizeStart() {},
      resizeComplete: function resizeComplete() {}
    };
    this.images = []; // used to compare for width changes

    this.eventgalleryPageWidth = 0; // the width of the container. This is kind of tricky since there can be many containers or just one.

    this.width = null;
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);

    if (undefined !== newOptions) {
      this.initialize();
    }
  };

  Eventgallery.Imagelist.prototype.initialize = function () {
    var _this = this;

    var currentObject = this;
    this.width = jQuery(this.options.imagesetContainer).width(); // save the current width so we don't react on an resize event if not necessary

    this.eventgalleryPageWidth = this.width;
    var images_tags = this.options.imageset;
    this.images = [];
    jQuery.each(images_tags, function (index, item) {
      currentObject.images.push(new Eventgallery.Image(item, index));
    });
    window.addEventListener('resize', function () {
      window.clearTimeout(_this.eventgalleryTimer);
      _this.eventgalleryTimer = setTimeout(function () {
        var new_width = jQuery(_this.options.imagesetContainer).width();
        _this.width = new_width;

        if (_this.eventgalleryPageWidth !== new_width) {
          _this.options.resizeStart();

          _this.eventgalleryPageWidth = new_width;
          jQuery(_this.options.imagesetContainer).css('min-height', _this.options.rowHeight * _this.images.length);

          _this.processList();

          jQuery(_this.options.imagesetContainer).css('min-height', '0px');

          _this.options.resizeComplete();
        }
      }, 500);
    });
    jQuery(this.options.imagesetContainer).css('min-height', this.options.rowHeight * this.images.length);
    this.processList();
    jQuery(this.options.imagesetContainer).css('min-height', '0px'); //add a tiny timeout. This prevents some issue with lazyload
    //where images didn't load since the offset was wrong.

    window.setTimeout(this.options.initComplete, 1);
  };
  /*calculated the with of an element*/


  Eventgallery.Imagelist.prototype.getRowWidth = function () {
    var rowWidth = this.width;
    /* fix for the internet explorer if width if 45.666% == 699.87px*/

    if (window.getComputedStyle) {
      rowWidth = Math.floor(parseFloat(window.getComputedStyle(this.options.imagesetContainer).width)) - 1;
    } else {
      rowWidth = rowWidth - 1;
    }

    return rowWidth;
  };
  /* processes the image list*/


  Eventgallery.Imagelist.prototype.processList = function () {
    var options;
    /* find out how much space we have*/

    var rowWidth = this.getRowWidth();
    /* get a copy of the image list because we will pop the image during iteration*/

    var imagesToProcess = this.images.slice(0);

    if (imagesToProcess.length === 0) {
      return;
    }
    /* display the first image larger */


    if (this.options.firstImageRowHeight > 1) {
      var image = imagesToProcess.shift();
      /*if we have a large image, we have to hide it to get the real available space*/

      image.tag.css('display', 'none');
      rowWidth = this.getRowWidth();
      image.tag.css('display', 'block');
      var imageHeight = this.options.firstImageRowHeight * this.options.rowHeight;
      var imageWidth = Math.floor(image.width / image.height * imageHeight);

      if (imageWidth + this.options.minImageWidth >= rowWidth) {
        imageWidth = rowWidth;
      }

      image.setSize(imageWidth, imageHeight);
      var rowHeightForRightSideImages = this.options.rowHeight; // in case the browser zooms to 110%, we need to make sure, the first image is smaller thand
      // the images to the right. We do this by checking if there is a height difference between the
      // height we want to get and the actual height. If there is one, we add a pixel to the rows
      // on the right side.

      if (imageHeight > image.getImageTagHeight()) {
        rowHeightForRightSideImages = (imageHeight + 1) / this.options.firstImageRowHeight;
      }

      options = {
        maxWidth: rowWidth - imageWidth,
        maxHeight: rowHeightForRightSideImages,
        adjustHeight: false
      };

      if (options.maxWidth > 0) {
        this.generateRows(imagesToProcess, this.options.firstImageRowHeight, options, false);
      }
    }

    options = {
      maxWidth: rowWidth,
      maxHeight: this.options.rowHeight,
      heightJitter: this.options.rowHeightJitter,
      doFillLastRow: this.options.doFillLastRow
    };
    this.generateRows(imagesToProcess, 99999, options, true);
  };
  /**
   * @param imagesToProcess
   * @param numberOfRowsToCreate
   * @param options
   * @param finalRows
   */


  Eventgallery.Imagelist.prototype.generateRows = function (imagesToProcess, numberOfRowsToCreate, options, finalRows) {
    var currentRow = new Eventgallery.Row(options);

    while (imagesToProcess.length > 0 && numberOfRowsToCreate > 0) {
      var addSuccessfull = currentRow.add(imagesToProcess[0]);

      if (addSuccessfull) {
        imagesToProcess.shift();
      } else {
        currentRow.processRow();
        numberOfRowsToCreate--;
        if (numberOfRowsToCreate === 0) break;
        currentRow = new Eventgallery.Row(options);
      }
    }

    if (finalRows) {
      currentRow.isLastRow = true;
    }

    currentRow.processRow();
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryJSGallery2.js":
/*!***********************************************!*\
  !*** ./frontend/js/EventgalleryJSGallery2.js ***!
  \***********************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);



(function (Eventgallery, jQuery) {
  /*
   *    Constructor. Starts up the whole thing :-)
   *
   *    This script is free to use. It has been created by http://www.aplusmedia.de and
   *    can be downloaded on http://www.esteak.net.
   *    License: GNU GPL 2.0: http://creativecommons.org/licenses/GPL/2.0/
   *    Example on: http://blog.aplusmedia.de/moo-gallery2
   *    Known issues:
   *    - preloading does not care about initialIndex param
   *    - hovering to a control over the border of the big image will make the other one flickering
   *    - if you enter and leave the control area very quickly, the control flickers sometimes
   *    - does not work in IE6
   *
   *    @param {Array} thumbs, An array of HTML elements
   *    @param {HTMLelement} bigImageContainer, the full size image
   *    @param {HTMLelement} pageContainer, If you have several pages, put them in this container
   *    @param {Object} options, You have to pass imagesPerPage if you have more than one!
   */
  Eventgallery.JSGallery2 = function (thumbs, bigImageContainer, pageContainer, newOptions) {
    this.options = {
      'prevHandle': null,
      //if you pass a previous page handle in here, it will be hidden if it's not needed
      'nextHandle': null,
      //like above, but for next page
      'countHandle': null,
      //handle of the counter variable
      'titleTarget': null,
      //target HTML element where image texts are copied into
      'initialIndex': -1,
      //which thumb to select after init. you could create deep links with it.
      'maxOpacity': 0.8,
      //maximum opacity before cursor reaches prev/next control, then it will be set to 1 instantly.
      'showSocialMediaButton': true,
      'showCartButton': true,
      'showCartConnector': false,
      'cartConnectorLinkRel': '',
      'activeClass': 'thumbnail-active',
      // the css class for the active thumbnail
      'lightboxRel': 'lightbo2',
      // the trigger rel for the lightbox script
      'touchContainerSelector': '#bigimageContainer'
    };
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
    var pages = jQuery(pageContainer).children('div'); // defines if thumbs are currently running

    this.running = false;
    this.currentPageNumber = 0;
    this.blockKeys = false;
    this.imagesPerFirstPage = jQuery(pages[0]).find('div.ajax-thumbnail-container').length;
    this.imagesPerPage = this.imagesPerFirstPage;

    if (pages.length > 1 && jQuery(pages[1]).find('div.ajax-thumbnail-container').length > 0) {
      this.imagesPerPage = jQuery(pages[1]).find('div.ajax-thumbnail-container').length;
    }

    this.thumbs = thumbs;
    this.bigImage = jQuery(bigImageContainer);
    this.pageContainer = jQuery(pageContainer);
    this.convertThumbs();
    this.lastPage = Math.ceil((this.thumbs.length - this.imagesPerFirstPage) / this.imagesPerPage) + 1;
    var url = document.location.href;
    this.initialIndex = parseInt(Eventgallery.Tools.getUrlHashParameterValue(url, 'imageno'));

    if (isNaN(this.initialIndex)) {
      this.initialIndex = 0;
    }

    this.createControls();
    this.createGallerySlides();
    this.gotoPage(0);

    if (this.options.initialIndex !== -1) {
      this.unBlockKeys();
      this.selectByIndex(this.options.initialIndex);
    } else if (this.initialIndex !== 0) {
      this.unBlockKeys();
      this.selectByIndex(this.initialIndex);
    }
  };

  Eventgallery.JSGallery2.prototype.createGallerySlides = function () {
    var _this = this;

    this.slides = [];
    jQuery.each(this.thumbs, function (count, thumbContainer) {
      var lightboxLinkElement = thumbContainer.getElementsByTagName('A')[0];
      var newSrc = lightboxLinkElement.getAttribute('rel');
      var title = decodeURIComponent(lightboxLinkElement.getAttribute('data-description'));
      var slide = {
        w: lightboxLinkElement.getAttribute('data-width'),
        h: lightboxLinkElement.getAttribute('data-height'),
        src: lightboxLinkElement.getAttribute('href'),
        title: title
      };

      _this.slides.push(slide);
    });
  };

  Eventgallery.JSGallery2.prototype.createControls = function () {
    var _this2 = this;

    this.prevLink = jQuery('<a href="#" class="link jsgallery-prev"></a>');
    this.prevLink.bind('click', jQuery.proxy(this.prevImage, this));
    this.prevLink.mouseleave(jQuery.proxy(this.mouseLeaveHandler, this));
    this.prevLink.mouseover(jQuery.proxy(function (e) {
      this.focusControl(e, this.prevLink);
    }, this));
    this.zoomLink = jQuery('<a href="#" class="link jsgallery-zoom"></a>');
    this.zoomLink.mouseleave(jQuery.proxy(this.mouseLeaveHandler, this));
    this.zoomLink.mouseover(jQuery.proxy(function (e) {
      this.focusControl(e, this.zoomLink);
    }, this));
    this.nextLink = jQuery('<a href="#" class="link jsgallery-next"></a>');
    this.nextLink.bind('click', jQuery.proxy(this.nextImage, this));
    this.nextLink.mouseleave(jQuery.proxy(this.mouseLeaveHandler, this));
    this.nextLink.mouseover(jQuery.proxy(function (e) {
      this.focusControl(e, this.nextLink);
    }, this));
    this.bigImage.parent().append(this.prevLink);
    this.bigImage.parent().append(this.zoomLink);
    this.bigImage.parent().append(this.nextLink);
    this.bigImage.on('load', function () {
      return _this2.showBigImage();
    });

    if (this.options.showCartButton) {
      this.add2cartLink = jQuery('<a href="#" class="eventgallery-add2cart eventgallery-openAdd2cart jsgallery-add2cart"><i class="egfa egfa-2x egfa-cart-plus"></i></a>');
      this.bigImage.parent().append(this.add2cartLink);
      jQuery('body').trigger('updatecartlinks');
    }

    if (this.options.showCartConnector) {
      this.cartConnectorLink = jQuery('<a href="#" id="ajax-cartconnector" class="button-cart-connector jsgallery-cartconnector"><i class="egfa egfa-2x egfa-cart-plus"></i></a>');
      this.cartConnectorLink.attr('rel', this.options.cartConnectorLinkRel);
      this.bigImage.parent().append(this.cartConnectorLink);
    }

    if (this.options.showSocialMediaButton) {
      this.socialmediabutton = jQuery('<a id="ajax-social-media-button" class="social-share-button social-share-button-open jsgallery-socialmedia" rel="nofollow" href="#"><i class="egfa egfa-2x egfa-share-alt-square"></i></a>');
      this.socialmediabutton.click(function (e) {
        return Eventgallery.SocialShareButton.openShareDialog(e);
      });
      this.bigImage.parent().append(this.socialmediabutton);
    }

    jQuery(document).keydown(jQuery.proxy(this.keyboardHandler, this));
    var options = {
      dragLockToAxis: true,
      dragBlockHorizontal: true,
      swipeVelocityX: 0.2
    };
    var swipeleft = jQuery.proxy(function (e) {
      this.nextImage(e);
    }, this);
    var swiperight = jQuery.proxy(function (e) {
      this.prevImage(e);
    }, this);

    var tabaction = function tabaction(e) {
      event.target.click();
    };

    Eventgallery.Touch.addTouch(this.options.touchContainerSelector, swiperight, swipeleft, tabaction, true);
    this.mouseLeaveHandler();
  };
  /**
   * Focuses one control
   *
   * @param {Event} event
   * @param {HTMLElement} control
  */


  Eventgallery.JSGallery2.prototype.focusControl = function (event, control) {
    control.css('opacity', 1);
  };
  /**
   * Hides the controls.
   */


  Eventgallery.JSGallery2.prototype.mouseLeaveHandler = function () {
    jQuery(this.nextLink).css('opacity', 0);
    jQuery(this.prevLink).css('opacity', 0);
    jQuery(this.zoomLink).css('opacity', 0);
  };
  /**
   * Handles keyboard interactions.
   * @param {Event} event
   */


  Eventgallery.JSGallery2.prototype.keyboardHandler = function (event) {
    if (!this.blockKeys && Eventgallery.lightbox.isOpen() !== true) {
      if (event.keyCode >= 49 && event.keyCode <= 57) {
        this.gotoPage(event.key - 1);
      } else if (event.keyCode == 37) {
        this.prevImage(event);
      } else if (event.keyCode == 39) {
        this.nextImage(event);
      }
    }
  };
  /**
   *    Returns the distance to the mouse from the middle of a given element.
   *    @param {HTMLelement} element
   *    @param {Event} event
   *    @return integer
   */


  Eventgallery.JSGallery2.prototype.getDistanceToMouse = function (element, event) {
    var s = jQuery(element);
    var xDiff = Math.abs(event.clientX - (s.position().left + s.width() / 2));
    var yDiff = Math.abs(event.clientY - (s.position().top + s.height() / 2));
    return Math.sqrt(Math.pow(xDiff, 2) + Math.pow(yDiff, 2));
  };

  Eventgallery.JSGallery2.prototype.resetThumbs = function () {
    this.running = false;
    this.convertThumbs(); //if we like to select another image on that page than the first one

    this.select(this.selectedContainer, true);
  };
  /**
   *    Adds the border to the thumbs and so on. (conversion of static thumbs)
   */


  Eventgallery.JSGallery2.prototype.convertThumbs = function () {
    var currentObject = this;
    jQuery.each(this.thumbs, function (count, thumbContainer) {
      currentObject.convertThumb(thumbContainer, count);
    });
  };
  /**
   * Converts one single thumb.
   * @param {HTMLelement} thumbContainer
   * @param {Integer} count
   */


  Eventgallery.JSGallery2.prototype.convertThumb = function (thumbContainer, count) {
    if (thumbContainer === undefined) {
      return;
    }

    var container = jQuery(thumbContainer);
    container.click(jQuery.proxy(function (e) {
      e.preventDefault();
      this.select(container);
    }, this));
    container.css('position', 'relative');
    container.attr('data-counter', count);
    container.attr('href', '#');
  };
  /**
   *    Removes key blocking.
   */


  Eventgallery.JSGallery2.prototype.unBlockKeys = function () {
    this.blockKeys = false;
  };
  /**
   *    Selects a certain image. (You have to pass the outer container of the image)
   *    @param container
   *    @param forceReload
   */


  Eventgallery.JSGallery2.prototype.select = function (container, forceReload) {
    forceReload = typeof forceReload !== 'undefined' ? forceReload : false;

    if (this.blockKeys || container === null) {
      return false;
    }

    this.blockKeys = true;

    if (this.selectedContainer !== undefined) {
      //this prevents an ugly effect if you click on the currently selected item
      if (container == this.selectedContainer && !forceReload) {
        this.unBlockKeys();
        return false;
      }

      this.deselect(this.selectedContainer);
    } // handle URL


    if (history && history.pushState) {
      history.pushState('', '', Eventgallery.Tools.addUrlHashParameter(window.location.href, 'imageno', this.thumbs.index(container)));
    } //if target image is not on current page, we have to go there first


    var targetPage = Math.floor((jQuery(container).data('counter') - this.imagesPerFirstPage) / this.imagesPerPage) + 1;

    if (this.currentPageNumber != targetPage) {
      this.gotoPage(targetPage, container);
    }

    this.selectedContainer = container;
    jQuery(container).addClass(this.options.activeClass); //first link in the container

    var source = jQuery(container).children().first(); // prepare the add2cart button

    if (this.options.showCartButton) {
      this.add2cartLink.attr('data-id', source.attr('data-id')); //jQuery('.eventgallery-add2cart').attr('data-id', source.data('id'));
    }

    if (this.options.showCartConnector) {
      this.cartConnectorLink.attr('data-folder', source.data('folder'));
      this.cartConnectorLink.attr('data-file', source.data('file'));
      this.cartConnectorLink.attr('href', decodeURIComponent(source.data('cart-connector-link')));
    }

    if (this.options.showSocialMediaButton) {
      this.socialmediabutton.attr('data-link', decodeURIComponent(source.data('social-sharing-link')));
    }

    jQuery(document).trigger('updatecartlinks'); // now lets set the image

    this.setImage(source);
  };
  /**
   * Selects an image by its thumbnail index.
   * @param {integer} index of the thumbnail, starting with 0
   */


  Eventgallery.JSGallery2.prototype.selectByIndex = function (index) {
    //this.mouseLeaveHandler();
    if (index < 0 || this.thumbs.length <= index) {
      index = 0;
    }

    this.select(this.thumbs[index]);
  };
  /**
   *    Opposite to method above.
   *    @param {HTMLelement} container
   */


  Eventgallery.JSGallery2.prototype.deselect = function (container) {
    jQuery(container).removeClass(this.options.activeClass);
  };
  /**
   *    Changes the full size image to given one.
   *    @param lightboxLinkElement
   */


  Eventgallery.JSGallery2.prototype.setImage = function (lightboxLinkElement) {
    var _this3 = this;

    this.bigImage.css('opacity', '0.1');
    var newSrc = lightboxLinkElement.attr('rel');
    var title = decodeURIComponent(lightboxLinkElement.attr('data-description'));
    this.zoomLink.unbind('click');
    var currentIndex = this.thumbs.index(this.selectedContainer);
    this.zoomLink.click(function (e) {
      _this3.createGallerySlides();

      Eventgallery.lightbox.openPhotoSwipe(currentIndex, _this3.slides, true, false);
      Eventgallery.lightbox.setAfterChangeEventListener(function () {
        var gid = Eventgallery.lightbox.getCurrentSlide().gid;

        if (_this3.slides.length > 0 && gid === _this3.slides[0].gid) {
          _this3.selectByIndex(Eventgallery.lightbox.getCurrentIndex());
        }
      });
    });

    if (Eventgallery.lightbox.isOpen() === true) {
      Eventgallery.lightbox.gotoSlide(currentIndex);
    }

    jQuery(this.options.titleTarget).html(title);
    this.bigImage.attr('src', newSrc);
    this.unBlockKeys();
  };

  Eventgallery.JSGallery2.prototype.showBigImage = function () {
    this.bigImage.css('opacity', '1');
  };
  /**
   *    Navigates to previous page.
   */


  Eventgallery.JSGallery2.prototype.prevPage = function () {
    this.gotoPage(this.currentPageNumber - 1);
  };
  /**
   *    Navigates to next page.
   */


  Eventgallery.JSGallery2.prototype.nextPage = function () {
    this.gotoPage(this.currentPageNumber + 1);
  };
  /**
   *    Selects the previous image.
   */


  Eventgallery.JSGallery2.prototype.prevImage = function (e) {
    if (e !== undefined) {
      e.preventDefault();
    }

    this.selectByIndex(this.thumbs.index(this.selectedContainer) - 1);
  };
  /**
   *    Selects the next image.
   */


  Eventgallery.JSGallery2.prototype.nextImage = function (e) {
    if (e !== undefined) {
      e.preventDefault();
    }

    this.selectByIndex(this.thumbs.index(this.selectedContainer) + 1);
  };
  /**
   * Zooms an image
   */


  Eventgallery.JSGallery2.prototype.zoomImage = function (e) {
    if (e !== undefined) {
      e.preventDefault();
    }
  };
  /**
   *    Navigates to given page and selects the first image of it.
   *    Also hides the handles (if set).
   *    @param {Integer} pageNumber, index of the target page (0-n)
   *  @param {HTMLElement} selectImage, optionally receives a particular image to select
   */


  Eventgallery.JSGallery2.prototype.gotoPage = function (pageNumber, selectImage) {
    //if we like to select another image on that page than the first one
    if (pageNumber === 0) {
      selectImage = selectImage === undefined ? this.thumbs[0] : selectImage;
    } else {
      var i = (pageNumber - 1) * this.imagesPerPage + this.imagesPerFirstPage;
      selectImage = this.thumbs[i] === undefined ? selectImage : this.thumbs[i];
    }

    if (pageNumber >= 0 && pageNumber < this.lastPage) {
      this.pageContainer.css('margin-left', this.pageContainer.children().width() * pageNumber * -1); // fix height of the page-container

      var maxHeight = 0;
      this.pageContainer.children().each(function (index, page) {
        var height = jQuery(page).height();

        if (height > maxHeight) {
          maxHeight = height;
        }
      });
      this.pageContainer.css('height', maxHeight);
      this.currentPageNumber = pageNumber;
      this.select(selectImage);
      this.updateHandles();
    }
  };

  Eventgallery.JSGallery2.prototype.updateHandles = function () {
    //update handles
    var dummy;

    if (this.options.prevHandle !== undefined) {
      dummy = this.currentPageNumber === 0 ? this.options.prevHandle.fadeOut() : this.options.prevHandle.fadeIn();
    }

    if (this.options.nextHandle !== undefined) {
      dummy = this.currentPageNumber == this.lastPage - 1 ? this.options.nextHandle.fadeOut() : this.options.nextHandle.fadeIn();
    }

    if (this.options.countHandle !== undefined) {
      dummy = this.updatePagingBar(this.options.countHandle, this.currentPageNumber, this.lastPage);
    }
  };

  Eventgallery.JSGallery2.prototype.updatePagingBar = function (countHandle, currentPage, pageCount) {
    var i; //init the pagingbar

    if (pageCount > 1 && countHandle.html() === '') {
      for (i = 0; i < pageCount; i++) {
        this.createCountLink(this, countHandle, i);
      }
    }

    var pageSpeed = this.options.pageSpeed;

    if (pageCount > 9) {
      for (i = 0; i < pageCount; i++) {
        jQuery('#count' + i).css('display', 'inline');
      }

      var skipFromRight = pageCount;
      var skipFromLeft = 0;
      var spaceToRight = pageCount - currentPage - 1;
      var spaceToLeft = currentPage;

      if (spaceToLeft > 4 && spaceToRight > 4) {
        skipFromLeft = currentPage - 4;
        skipFromRight = currentPage + 5;
      } else {
        if (spaceToLeft <= 4) {
          skipFromLeft = 0;
          skipFromRight = currentPage + 5 + (4 - spaceToLeft);
        }

        if (spaceToRight <= 4) {
          skipFromLeft = currentPage - 4 - (4 - spaceToRight);
          skipFromRight = pageCount;
        }
      }

      for (i = 0; i < skipFromLeft; i++) {
        jQuery('#count' + i).css('display', 'none');
      }

      for (i = skipFromRight; i < pageCount; i++) {
        jQuery('#count' + i).css('display', 'none');
      }
    }

    jQuery(countHandle).children('.active').removeClass('active');
    jQuery('#count' + currentPage).addClass('active');
  };

  Eventgallery.JSGallery2.prototype.createCountLink = function (gallery, countHandle, currentPageNumber) {
    var myAnchor = jQuery('<a class="page-link" href="#">' + (currentPageNumber + 1) + '</a>');
    myAnchor.click(jQuery.proxy(function (e) {
      this.gotoPage(currentPageNumber);
      return false;
    }, gallery));
    var myListItem = jQuery('<li class="count page-item" id="count' + currentPageNumber + '"></li>');
    myListItem.append(myAnchor);
    countHandle.append(myListItem);
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryLazyload.js":
/*!*********************************************!*\
  !*** ./frontend/js/EventgalleryLazyload.js ***!
  \*********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ EventgalleryLazyload
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var EventgalleryLazyload = /*#__PURE__*/function () {
  function EventgalleryLazyload() {
    _classCallCheck(this, EventgalleryLazyload);

    this.options = {
      elementSelector: 'img.eventgallery-lazyme',
      classForLoaded: 'eventgallery-lazyload-loaded',
      classForLoading: 'eventgallery-lazyload-loading'
    };

    if ('IntersectionObserver' in window && 'IntersectionObserverEntry' in window && 'intersectionRatio' in window.IntersectionObserverEntry.prototype) {
      // Minimal polyfill for Edge 15's lack of `isIntersecting`
      // See: https://github.com/w3c/IntersectionObserver/issues/211
      if (!('isIntersecting' in window.IntersectionObserverEntry.prototype)) {
        Object.defineProperty(window.IntersectionObserverEntry.prototype, 'isIntersecting', {
          get: function get() {
            return this.intersectionRatio > 0;
          }
        });
      }

      this.imageObserver = new IntersectionObserver(function (entries, imgObserver) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            var lazyImage = entry.target;

            if (lazyImage.dataset.src) {
              lazyImage.style.backgroundImage = EventgalleryLazyload.createBackgroundImageUrl(lazyImage.dataset.src);

              if (!EventgalleryLazyload.knownImageUrls.includes(lazyImage.dataset.src)) {
                EventgalleryLazyload.knownImageUrls.push(lazyImage.dataset.src);
                lazyImage.classList.add('eventgallery-lazyload-loading');
                lazyImage.classList.remove('eventgallery-lazyload-loaded');
                var img = document.createElement('img');
                img.src = lazyImage.dataset.src;

                img.onload = function () {
                  console.log('image loaded');
                  lazyImage.classList.remove('eventgallery-lazyload-loading');
                  lazyImage.classList.add('eventgallery-lazyload-loaded');
                };
              }
            }
          }
        });
      });
    }
  }

  _createClass(EventgalleryLazyload, null, [{
    key: "createBackgroundImageUrl",
    value: function createBackgroundImageUrl(backgroundImageUrl) {
      return 'url("' + backgroundImageUrl + '")';
    }
  }, {
    key: "watchImages",
    value: function watchImages() {
      if (!EventgalleryLazyload.instance) {
        EventgalleryLazyload.instance = new EventgalleryLazyload();
      } else {
        return;
      }

      var lazyImages = document.querySelectorAll(EventgalleryLazyload.instance.options.elementSelector);

      for (var i = 0; i < lazyImages.length; i++) {
        var lazyImage = lazyImages[i];

        if (lazyImage.dataset.src) {
          if (EventgalleryLazyload.instance.imageObserver) {
            EventgalleryLazyload.instance.imageObserver.observe(lazyImage);
          } else {
            lazyImage.style.backgroundImage = EventgalleryLazyload.createBackgroundImageUrl(lazyImage.dataset.src);
          }
        }
      }
    }
  }]);

  return EventgalleryLazyload;
}();

_defineProperty(EventgalleryLazyload, "instance", null);

_defineProperty(EventgalleryLazyload, "knownImageUrls", []);



/***/ }),

/***/ "./frontend/js/EventgalleryRow.js":
/*!****************************************!*\
  !*** ./frontend/js/EventgalleryRow.js ***!
  \****************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  /* processes a row is a image list */
  Eventgallery.Row = function (newOptions) {
    this.options = {
      maxWidth: 960,
      maxHeight: 250,
      heightJitter: 0,
      adjustHeight: true,
      doFillLastRow: true
    };
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
    this.isLastRow = false;
    this.images = [];
    this.width = 0;

    if (this.options.heightJitter > 0) {
      this.options.maxHeight = Math.floor(this.options.maxHeight + Math.random() * 2 * this.options.heightJitter - this.options.heightJitter);
    }
  };

  Eventgallery.Row.prototype.add = function (eventgalleryImage) {
    var imageWidth = eventgalleryImage.width / eventgalleryImage.height * this.options.maxHeight; // determine the number of images per line. return false if the row if full.

    var addThisImage = this.width + imageWidth <= this.options.maxWidth || this.images.length === 0;

    if (!addThisImage) {
      var gap = Math.abs(this.options.maxWidth - this.width - imageWidth) / this.options.maxWidth;

      if (gap < 0.2) {
        addThisImage = true;
      }
    } // determine the number of images per line. return false if the row if full.


    if (addThisImage) {
      this.images.push(eventgalleryImage);
      eventgalleryImage.calculatedWidth = imageWidth;
      this.width = this.width + imageWidth;
      return true;
    } else {
      return false;
    }
  };

  Eventgallery.Row.prototype.processRow = function () {
    var gap, rowHeight, i;
    gap = this.options.maxWidth - this.width; // if there is no gap to fill, we need to resize the last row to fit the image.

    if (this.isLastRow && this.options.doFillLastRow === false && gap >= 0) {
      if (gap >= 0) {
        gap = 0;
      }

      rowHeight = this.options.maxHeight;
    } else {
      rowHeight = this.options.maxHeight / (this.width / this.options.maxWidth);
    }

    if (this.options.adjustHeight === false) {
      rowHeight = this.options.maxHeight;
    }

    for (i = 0; i < this.images.length; i++) {
      var image = this.images[i];
      var calculatedWidth = image.calculatedWidth; // how much of the gap does this element need to fill?

      var gapToClose = calculatedWidth / this.width * gap;
      image.setSize(calculatedWidth + gapToClose, rowHeight);
    }
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgallerySizeCalculator.js":
/*!***************************************************!*\
  !*** ./frontend/js/EventgallerySizeCalculator.js ***!
  \***************************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery) {
  /* determines the size of an image so a image server can deliver it. */
  Eventgallery.SizeCalculator = function (newOptions) {
    this.options = {
      // to be able to handle internal and google picasa images, we need to restrict the availabe image sizes.
      availableSizes: [48, 104, 160, 288, 320, 400, 512, 640, 720, 800, 1024, 1280, 1440],
      flickrSizes: {
        100: 't',
        240: 'm',
        320: 'n',
        500: '-',
        640: 'z',
        800: 'c',
        1024: 'b',
        1600: 'h',
        2048: 'k'
      }
    };
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
  };

  Eventgallery.SizeCalculator.prototype.adjustImageURL = function (url, size) {
    url = url.replace(/=w(\d+)/, '=w' + size);
    url = url.replace(/width=(\d+)/, 'width=' + size);
    url = url.replace(/\/s(\d*)\//, '/s' + size + '/');
    url = url.replace(/\/s(\d*)-c\//, '/s' + size + '-c/');
    return url;
  };

  Eventgallery.SizeCalculator.prototype.getFlickrURL = function (farm, server, secret, secret_h, secret_k, secret_o, id, width, height, originalwidth, originalheight) {
    var longSideSize, originalLongSideSize, sizeCode, secretString, sizeString, ratio;
    var minSizes = this.getMinSizes(width, height, originalwidth, originalheight);

    if (originalwidth > originalheight) {
      longSideSize = minSizes.width;
      originalLongSideSize = originalwidth;
    } else {
      longSideSize = minSizes.height;
      originalLongSideSize = originalheight;
    }

    if (originalLongSideSize < longSideSize) {
      sizeCode = 'o';
    } else {
      for (var size in this.options.flickrSizes) {
        if (size > longSideSize) {
          sizeCode = this.options.flickrSizes[size];
          break;
        }
      }
    }

    if (sizeCode === 'h' && secret_h === '') {
      sizeCode = 'o';
    }

    if (sizeCode === 'k' && secret_k === '') {
      sizeCode = 'o';
    }

    switch (sizeCode) {
      case "o":
        secretString = secret_o;
        break;

      case "h":
        secretString = secret_h;
        break;

      case "k":
        secretString = secret_k;
        break;

      default:
        secretString = secret;
    }

    sizeString = sizeCode == '-' ? '' : '_' + sizeCode;
    return 'https://farm' + farm + '.staticflickr.com/' + server + '/' + id + '_' + secretString + sizeString + '.jpg';
  };

  Eventgallery.SizeCalculator.prototype.getSize = function (width, height, ratio) {
    var googleWidth = this.options.availableSizes[0];

    for (var index = 0; index < this.options.availableSizes.length; index++) {
      var item = this.options.availableSizes[index];
      var widthOkay;
      var heightOkay;

      if (googleWidth > this.options.availableSizes[0]) {
        break;
      }

      var lastItem = index == this.options.availableSizes.length - 1;

      if (ratio >= 1) {
        widthOkay = item > width;
        heightOkay = item / ratio > height;

        if (widthOkay && heightOkay || lastItem) {
          googleWidth = item;
        }
      } else {
        heightOkay = item > height;
        widthOkay = item * ratio > width;

        if (widthOkay && heightOkay || lastItem) {
          googleWidth = item;
        }
      }
    }

    return googleWidth;
  };
  /**
   * returns the minimum values for height and width to fill the given box size.
   * @param boxWidth
   * @param boxHeight
   * @param originalWidth
   * @param originalHeight
   */


  Eventgallery.SizeCalculator.prototype.getMinSizes = function (boxWidth, boxHeight, originalWidth, originalHeight) {
    var ratio = originalWidth / originalHeight;
    var height, width;

    if (originalWidth > originalHeight) {
      if (boxWidth > boxHeight) {
        width = boxWidth;
        height = boxWidth / ratio;

        if (height < boxHeight) {
          height = boxHeight;
          width = boxHeight * ratio;
        }
      } else {
        height = boxHeight;
        width = boxHeight * ratio;

        if (width < boxWidth) {
          width = boxWidth;
          height = boxHeight * ratio;
        }
      }
    } else {
      if (boxWidth > boxHeight) {
        width = boxWidth;
        height = boxWidth / ratio;

        if (height < boxHeight) {
          height = boxHeight;
          width = boxHeight * ratio;
        }
      } else {
        height = boxHeight;
        width = boxHeight * ratio;

        if (width < boxWidth) {
          width = boxWidth;
          height = boxWidth / ratio;
        }
      }
    }

    return {
      width: Math.ceil(width),
      height: Math.ceil(height)
    };
  };
})(Eventgallery);

/***/ }),

/***/ "./frontend/js/EventgallerySocialShareButton.js":
/*!******************************************************!*\
  !*** ./frontend/js/EventgallerySocialShareButton.js ***!
  \******************************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

(function (Eventgallery, jQuery) {
  Eventgallery.DownloadButton = /*#__PURE__*/function () {
    function _class() {
      _classCallCheck(this, _class);
    }

    _createClass(_class, null, [{
      key: "download",
      value: function download(e, href, _download) {
        e.preventDefault();
        var a = document.createElement('a');
        a.href = href;
        a.download = _download;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      }
    }]);

    return _class;
  }();

  Eventgallery.ClickableButton = /*#__PURE__*/function () {
    function _class2() {
      _classCallCheck(this, _class2);
    }

    _createClass(_class2, null, [{
      key: "click",
      value: function click(e, href) {
        e.preventDefault();
        document.location.href = href;
      }
    }]);

    return _class2;
  }();

  Eventgallery.SocialShareButton = /*#__PURE__*/function () {
    function _class3() {
      _classCallCheck(this, _class3);
    }

    _createClass(_class3, null, [{
      key: "openShareDialog",
      value: function openShareDialog(e) {
        e.preventDefault();
        e.stopPropagation();
        var link = jQuery(e.target);

        if (!link.attr('data-link')) {
          link = link.parent('[data-link]');
        }

        var id = 'id_' + Math.ceil(Math.random() * 10000000);
        var targetPos = link.offset();
        var myDiv = jQuery('<div><i class="egfa egfa-2x egfa-cog egfa-spin"></i></div>');
        myDiv.attr('id', id);
        myDiv.addClass('social-sharing-toolbox');
        myDiv.css({
          'opacity': '1 !important',
          'position': 'absolute',
          'top': targetPos.top - 10,
          'left': targetPos.left - 10
        });
        jQuery('body').append(myDiv);
        myDiv.fadeIn();
        myDiv.load(link.attr('data-link'));
        var timer = null;

        var closeFunction = function closeFunction() {
          myDiv.fadeOut(300, function () {
            jQuery(this).remove();
          });
          jQuery(document).off('touchend click', closeFunction2);
        };

        myDiv.mouseleave(function () {
          timer = window.setTimeout(closeFunction, 1000);
        });
        myDiv.mouseenter(function () {
          window.clearTimeout(timer);
        }); // this method is used to close the sharing windows if we click somewhere else.

        var closeFunction2 = function closeFunction2(e) {
          if (e.target.id != id && jQuery(e.target).parents('#' + id).length === 0) {
            closeFunction();
          }
        };

        jQuery(document).on('touchend click', closeFunction2);
      }
    }]);

    return _class3;
  }();

  jQuery(document).ready(function () {
    jQuery(document).on('touchend click', '.social-share-button-close', function (e) {
      e.preventDefault();
      var myDivs = jQuery(e.target).parents('.social-sharing-toolbox');
      myDivs.fadeOut(300, function () {
        jQuery(this).remove();
      });
    });
    var elements = document.querySelectorAll('.social-share-button-open');

    for (var i = 0; i < elements.length; i++) {
      elements[i].addEventListener("click", function (e) {
        Eventgallery.SocialShareButton.openShareDialog(e);
      }, true);
    }

    elements = document.querySelectorAll('.eg-download');

    var _loop = function _loop(_i) {
      var element = elements[_i];
      var href = element.getAttribute('data-href');
      var download = element.getAttribute('data-download');

      if (download != null) {
        element.addEventListener("click", function (e) {
          Eventgallery.DownloadButton.download(e, href, download);
        }, true);
      } else {
        element.addEventListener("click", function (e) {
          Eventgallery.ClickableButton.click(e, href);
        }, true);
      }
    };

    for (var _i = 0; _i < elements.length; _i++) {
      _loop(_i);
    }
  });
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgallerySquareList.js":
/*!***********************************************!*\
  !*** ./frontend/js/EventgallerySquareList.js ***!
  \***********************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  /**
   * Formats a list of images to appear square sized. This class is doing something like the Grid layout for events.
   * @param newOptions
   * @constructor
   */
  Eventgallery.SquareList = function (newOptions) {
    Eventgallery.Imagelist.call(this, newOptions);
  };

  Eventgallery.SquareList.prototype = new Eventgallery.Imagelist();
  Eventgallery.SquareList.prototype.constructor = Eventgallery.SquareList;

  Eventgallery.SquareList.prototype.processList = function () {
    /* processes the image list*/
    var width = this.width;
    var currentObject = this;
    jQuery.each(this.images, function () {
      this.setSize(width, width);
    });
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryTilesCollection.js":
/*!****************************************************!*\
  !*** ./frontend/js/EventgalleryTilesCollection.js ***!
  \****************************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  // create a tile layout and centers images in a tile
  Eventgallery.TilesCollection = function (newOptions) {
    this.options = {
      tiles: jQuery('#events-tiles .event'),
      tilesContainer: jQuery('#events-tiles .event-tiles')
    };
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
    this.tiles = this.options.tiles;
    this.tilesContainer = this.options.tilesContainer;
  };

  Eventgallery.TilesCollection.prototype.calculate = function () {
    var i;
    var currentObject = this;
    var tilesPerRow = 1;
    var tile = jQuery(this.tiles[0]); // reset grid to support resize and media queries

    jQuery.each(this.tiles, function (index, tile) {
      jQuery(tile).css({
        'visibility': 'hidden',
        'position': 'static',
        'float': 'left'
      });
    }); // calculate tiles per row    

    var y = tile.position().top;

    for (i = 1; i < this.tiles.length; i++) {
      if (jQuery(this.tiles[i]).position().top != y) {
        break;
      }

      tilesPerRow++;
    } // create array of height values for the columns


    var columnHeight = [];

    for (i = 0; i < tilesPerRow; i++) {
      columnHeight.push(0);
    }

    var columnWidth = tile.outerWidth();
    jQuery.each(this.tiles, function (index, tile) {
      var $tile = jQuery(tile);
      $tile.data('height', $tile.outerHeight());
    });
    jQuery.each(this.tiles, function (index, tile) {
      var $tile = jQuery(tile),
          smallestColumn = currentObject.getSmallestColumn(columnHeight);
      $tile.css({
        'left': smallestColumn * columnWidth,
        'top': columnHeight[smallestColumn]
      });
      columnHeight[smallestColumn] = columnHeight[smallestColumn] + $tile.data('height');
    });
    jQuery.each(this.tiles, function (index, tile) {
      jQuery(tile).css({
        'visibility': 'visible',
        'position': 'absolute',
        'float': 'none'
      });
    });
    jQuery(this.tilesContainer).css('height', columnHeight[this.getHighestColumn(columnHeight)]);
  };
  /* 
  * returns the position of the smallest value in the array
  */


  Eventgallery.TilesCollection.prototype.getSmallestColumn = function (columnHeight) {
    var smallestColumnValue = columnHeight[0];
    var smallestColumnNumber = 0;

    for (var i = 0; i < columnHeight.length; i++) {
      if (smallestColumnValue > columnHeight[i]) {
        smallestColumnValue = columnHeight[i];
        smallestColumnNumber = i;
      }
    }

    return smallestColumnNumber;
  };
  /* 
  * returns the position of the highest value in the array
  */


  Eventgallery.TilesCollection.prototype.getHighestColumn = function (columnHeight) {
    var columnValue = columnHeight[0];
    var columnNumber = 0;

    for (var i = 0; i < columnHeight.length; i++) {
      if (columnValue < columnHeight[i]) {
        columnValue = columnHeight[i];
        columnNumber = i;
      }
    }

    return columnNumber;
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/EventgalleryTouch.js":
/*!******************************************!*\
  !*** ./frontend/js/EventgalleryTouch.js ***!
  \******************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (Eventgallery, jQuery) {
  /**
   * Touch navigation
   */
  Eventgallery.Touch = function (newOptions) {
    this.options = {};
    this.options = Eventgallery.Tools.mergeObjects(this.options, newOptions);
  };

  Eventgallery.Touch.removeTouch = function (elementSelector) {
    jQuery(elementSelector).unbind('touchstart');
    jQuery(elementSelector).unbind('touchmove');
    jQuery(elementSelector).unbind('touchend');
  };

  Eventgallery.Touch.addTouch = function (elementSelector, leftAction, rightAction, tabAction, allowScrolling) {
    var index,
        hDistance,
        vDistance,
        hDistanceLast,
        vDistanceLast,
        hDistancePercent,
        vSwipe = false,
        hSwipe = false,
        hSwipMinDistance = 10,
        vSwipMinDistance = 50,
        startCoords = {},
        endCoords = {},
        winWidth = window.innerWidth ? window.innerWidth : $(window).width(),
        winHeight = window.innerHeight ? window.innerHeight : $(window).height();
    jQuery(elementSelector).bind('touchstart', function (event) {
      jQuery(this).addClass('touching');
      endCoords = event.originalEvent.targetTouches[0];
      startCoords.pageX = event.originalEvent.targetTouches[0].pageX;
      startCoords.pageY = event.originalEvent.targetTouches[0].pageY;
      jQuery('.touching').bind('touchmove', function (event) {
        if (allowScrolling !== true) {
          event.preventDefault();
          event.stopPropagation();
        }

        endCoords = event.originalEvent.targetTouches[0];

        if (!hSwipe) {
          vDistanceLast = vDistance;
          vDistance = endCoords.pageY - startCoords.pageY;

          if (Math.abs(vDistance) >= vSwipMinDistance || vSwipe) {
            vSwipe = true;
          }
        }

        hDistanceLast = hDistance;
        hDistance = endCoords.pageX - startCoords.pageX;
        hDistancePercent = hDistance * 100 / winWidth;

        if (!hSwipe && !vSwipe && Math.abs(hDistance) >= hSwipMinDistance) {
          hSwipe = true;
        }
      });
      return allowScrolling === true;
    }).bind('touchend', function (event) {
      event.preventDefault();
      event.stopPropagation();
      vDistance = endCoords.pageY - startCoords.pageY;
      hDistance = endCoords.pageX - startCoords.pageX;
      hDistancePercent = hDistance * 100 / winWidth; // Swipe to bottom to close

      if (vSwipe) {
        vSwipe = false;

        if (Math.abs(vDistance) >= 2 * vSwipMinDistance && Math.abs(vDistance) > Math.abs(vDistanceLast)) {} else {}
      } else if (hSwipe) {
        hSwipe = false; // swipeLeft

        if (hDistance >= hSwipMinDistance && hDistance >= hDistanceLast) {
          leftAction(); // swipeRight
        } else if (hDistance <= -hSwipMinDistance && hDistance <= hDistanceLast) {
          rightAction();
        }
      } else {
        // Top and bottom bars have been removed on touchable devices
        if (undefined !== tabAction) {
          tabAction();
        } else {
          jQuery(event.target).trigger("click");
        }
      }

      jQuery('.touching').off('touchmove').removeClass('touching');
    });
  };
})(Eventgallery, Eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/Modules.js":
/*!********************************!*\
  !*** ./frontend/js/Modules.js ***!
  \********************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

(function (jQuery) {})(eventgallery.jQuery);

/***/ }),

/***/ "./frontend/js/Overlay.js":
/*!********************************!*\
  !*** ./frontend/js/Overlay.js ***!
  \********************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ Overlay
/* harmony export */ });
/* harmony import */ var _Polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Polyfill */ "./frontend/js/Polyfill.ts");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


/**
 * this class is the basic modal of Event Gallery.
 */

var Overlay = /*#__PURE__*/function () {
  function Overlay() {
    _classCallCheck(this, Overlay);

    this.myDiv = null;
    this.background = null;
    this.$body = jQuery('body');
    this.onClosed = undefined;
    this.onLoad = undefined;
    this.repositionTimer = null;
    this.windowWidth = 0;
  }
  /**
   * opens an overlay. The content can be a url or content.
   * Url start with http or /
   *
   * @param dataUrl
   */


  _createClass(Overlay, [{
    key: "openOverlay",
    value: function openOverlay(dataUrl) {
      var _this = this;

      this.myDiv = jQuery('<div id="eventgallery-overlay"><i class="egfa egfa-2x egfa-cog egfa-spin"></i></div>');
      this.background = jQuery('<div id="eventgallery-overlay-background"></div>');

      this.background[0].onclick = function () {
        _this.closeOverlay();
      };

      this.myDiv.css({
        'opacity': '1 !important',
        'position': 'absolute',
        'max-width': '100%'
      });
      this.$body.append(this.background);
      this.$body.append(this.myDiv);
      this.reposition(true);

      if (dataUrl.startsWith('http') || dataUrl.startsWith('/')) {
        Overlay._getRemoteData(dataUrl, function (data) {
          _this._addContent(data);
        });
      } else {
        this._addContent("<button class=\"btn-close-overlay eventgallery-close-overlay\"><i class=\"egfa egfa-2x egfa-times-circle\"></i></button>" + dataUrl);
      }

      jQuery(window).on('resize.overlay', function () {
        _this._setRositionTimer(false);
      });
    }
    /**
     * triggers a timeout for the repositioning. This will avoid too much flickering.
     *
     * @param force
     * @private
     */

  }, {
    key: "_setRositionTimer",
    value: function _setRositionTimer(force) {
      var _this2 = this;

      if (this.repositionTimer) {
        clearTimeout(this.repositionTimer);
      }

      this.repositionTimer = setTimeout(function () {
        return _this2.reposition(force);
      }, 500);
    }
  }, {
    key: "_addContent",

    /**
     * moves the given content into the content overlay. Executes the onload method when finished.
     *
     * @param content
     * @private
     */
    value: function _addContent(content) {
      var _this3 = this;

      this.myDiv.html(content);
      var elements = this.myDiv[0].getElementsByClassName('eventgallery-close-overlay');

      for (var i = 0; i < elements.length; i++) {
        elements[i].onclick = function () {
          _this3.closeOverlay();
        };
      }

      this.reposition(true);

      if (this.onLoad !== undefined) {
        this.onLoad();
      }

      document.dispatchEvent(_Polyfill__WEBPACK_IMPORTED_MODULE_0__.default.createNewEvent('eventgallery-images-added'));
    }
    /**
     * Closes the overlay and fires the onclose method if defined.
     */

  }, {
    key: "closeOverlay",
    value: function closeOverlay() {
      var _this4 = this;

      jQuery(window).off('.overlay');
      this.myDiv.fadeOut(150, function () {
        jQuery(_this4.myDiv).remove();

        _this4.background.fadeOut(200, function () {
          jQuery(_this4.background).remove();

          if (_this4.onClosed !== undefined) {
            _this4.onClosed();
          }
        });
      });
    }
    /**
     * Move the overlay to a good position.
     *
     * @param force defines if we force the reposition. If set to false, we do it only in case the width of the window changed.
     */

  }, {
    key: "reposition",
    value: function reposition(force) {
      if (this.repositionTimer !== null) {
        clearTimeout(this.repositionTimer);
      }

      var maxWidth = jQuery(window).width();

      if (!force) {
        if (this.windowWidth === maxWidth) {
          return;
        }
      }

      this.windowWidth = maxWidth;
      this.myDiv.hide();
      this.myDiv.css({
        'top': 0,
        'left': 0
      });
      var maxHeight = jQuery(window).height(),
          width = this.myDiv.outerWidth(),
          height = this.myDiv.outerHeight(),
          scrollTop = jQuery(window).scrollTop(),
          left = 0,
          top = scrollTop;

      if (maxWidth - width > 0) {
        left = (maxWidth - width) / 2;
      }

      if (maxHeight - height > 0) {
        top = scrollTop + (maxHeight - height) / 2;
      }

      this.myDiv.css({
        'top': top,
        'left': left
      });
      this.myDiv.show();
    }
  }], [{
    key: "_getRemoteData",
    value: function _getRemoteData(url, callback) {
      jQuery.ajax({
        url: url
      }).done(callback);
    }
  }]);

  return Overlay;
}();



/***/ }),

/***/ "./frontend/js/PhotoSwipeGallery.js":
/*!******************************************!*\
  !*** ./frontend/js/PhotoSwipeGallery.js ***!
  \******************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ PhotoSwipeGallery
/* harmony export */ });
/* harmony import */ var _PhotoSwipeGallerySlide_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./PhotoSwipeGallerySlide.js */ "./frontend/js/PhotoSwipeGallerySlide.js");
/* harmony import */ var _photoswipe_photoswipe__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../photoswipe/photoswipe */ "./photoswipe/photoswipe.js");
/* harmony import */ var _photoswipe_photoswipe_ui_default_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../photoswipe/photoswipe-ui-default.js */ "./photoswipe/photoswipe-ui-default.js");
/* harmony import */ var _Polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Polyfill */ "./frontend/js/Polyfill.ts");
/* harmony import */ var _Overlay__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Overlay */ "./frontend/js/Overlay.js");
/* harmony import */ var _SlideShow__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SlideShow */ "./frontend/js/SlideShow.js");
/* harmony import */ var _common_js_Helpers__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../common/js/Helpers */ "./common/js/Helpers.js");
function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }








var PSWP_CONTROLS_MAIN_ELEMENT_CLASS = 'pswp';
var PSW_CONTROLS_SLIDESHOW_BUTTON_ELEMENT_CLASS = 'pswp__button--playpause';
var PSW_HIDE_CLASS = 'pswp_hide';
var PSWP_CONTROLS = "<div class=\"pswp\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n\t    \t<div class=\"pswp__bg\"></div>\n\t    \t<div class=\"pswp__scroll-wrap\">\n\t        <div class=\"pswp__container\">\n\t            <div class=\"pswp__item\"></div>\n\t            <div class=\"pswp__item\"></div>\n\t            <div class=\"pswp__item\"></div>\n\t        </div>\n\t        <div class=\"pswp__ui pswp__ui--hidden\">\n\t            <div class=\"pswp__top-bar\">\n\t                <div class=\"pswp__counter\"></div>\n\t                <button class=\"pswp__button pswp__button--close\" title=\"{{CLOSE}}\"></button>\n\t                <button class=\"pswp__button pswp__button--share\" title=\"{{SHARE}}\"></button>\n\t                <button class=\"pswp__button pswp__button--download\" title=\"{{DOWNLOAD}}\"></button>\n\t                <button class=\"pswp__button pswp__button--add2cart\" title=\"{{BUY}}\"></button>\n\t                <button class=\"pswp__button pswp__button--fs\" title=\"{{FULLSCREEN}}\"></button>\n\t                <button class=\"pswp__button pswp__button--playpause pswp_hide\" data-title-pause=\"{{PAUSESLIDESHOW}}\" data-title-play=\"{{PLAYSLIDESHOW}}\" title=\"{{PLAYSLIDESHOW}}\"></button>\n\t                <button class=\"pswp__button pswp__button--zoom\" title=\"{{ZOOM}}\"></button>\n\t                <div class=\"pswp__preloader\">\n\t                    <div class=\"pswp__preloader__icn\">\n\t                      <div class=\"pswp__preloader__cut\">\n\t                        <div class=\"pswp__preloader__donut\"></div>\n\t                      </div>\n\t                    </div>\n\t                </div>\n\t            </div>\n\t            <div class=\"pswp__share-modal pswp__share-modal--hidden pswp__single-tap\">\n\t                <div class=\"pswp__share-tooltip\"></div> \n\t            </div>\n\t            <button class=\"pswp__button pswp__button--arrow--left\" title=\"{{PREVIOUS}}\">\n\t            </button>\n\t            <button class=\"pswp__button pswp__button--arrow--right\" title=\"{{NEXT}}\">\n\t            </button>\n\t            <div class=\"pswp__caption\">\n\t                <div class=\"pswp__caption__center\"></div>\n\t            </div>\n\t          </div>\n\t        </div>\n\t\t</div>";

var PhotoSwipeGallery = /*#__PURE__*/function () {
  function PhotoSwipeGallery() {
    _classCallCheck(this, PhotoSwipeGallery);

    this._isOpen = false;
    this._gallery = null;
  }
  /**
   * Finds all thumbnail containers on the page
   * @returns {NodeListOf<Element>}
   */


  _createClass(PhotoSwipeGallery, [{
    key: "getSlideBy",

    /**
     * searches the galleries for a thumbnail container and returns the
     * Slide object
     *
     * @param thumbnailContainer
     * @returns PhotoSwipeGallerySlide
     */
    value: function getSlideBy(thumbnailContainer) {
      var galleries = this.getGalleries();

      var _iterator = _createForOfIteratorHelper(galleries.values()),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var gallery = _step.value;

          for (var i = 0, l = gallery.length; i < l; i++) {
            if (gallery[i].thumbnailContainer === thumbnailContainer) {
              return gallery[i];
            }
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      return null;
    }
    /**
     *
     * @param slide PhotoSwipeGallerySlide
     * @returns {*|number}
     */

  }, {
    key: "getIndexOfSlide",
    value: function getIndexOfSlide(slide) {
      var slides = this.getGalleries().get(slide.gid);
      return slides.map(function (e) {
        return e.hash();
      }).indexOf(slide.hash());
    }
    /**
     * Parses all elements on the page so we know which triggers for a lightbox exist.
     * Returns a mal containing the gallery and all elements
     * @returns {Map<String, Array>}
     */

  }, {
    key: "getGalleries",
    value: function getGalleries() {
      var galleries = new Map(),
          thumbnails = PhotoSwipeGallery.getThumbnailContainers();

      for (var i = 0; i < thumbnails.length; i++) {
        var thumbnailContainer = thumbnails[i];
        var gallery = void 0;
        var item = PhotoSwipeGallery.parseThumbnailElement(thumbnailContainer);

        if (item !== null) {
          if (galleries.get(item.gid) === undefined) {
            galleries.set(item.gid, []);
          }

          gallery = galleries.get(item.gid);
          gallery.push(item);
          galleries.set(item.gid, gallery);
        }
      }

      return galleries;
    }
  }, {
    key: "onThumbnailsClick",
    value: function onThumbnailsClick(e) {
      e = e || window.event;
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      var eTarget = e.target || e.srcElement; // leave the icons for cart&sharing alone

      var iconContainer = PhotoSwipeGallery.closest(eTarget, function (el) {
        return el.classList && el.classList.contains('eventgallery-icon-container');
      });

      if (iconContainer !== null) {
        return;
      } // find root element of slide


      var clickedListItem = PhotoSwipeGallery.closest(eTarget, function (el) {
        return el.tagName && el.tagName.toUpperCase() === 'A';
      });

      if (!clickedListItem) {
        return;
      }

      var slide = this.getSlideBy(clickedListItem);
      var index = this.getIndexOfSlide(slide);
      var slides = this.getGalleries().get(slide.gid);

      if (index >= 0) {
        // open PhotoSwipe if valid index found
        this.openPhotoSwipe(index, slides);
      }

      return false;
    }
  }, {
    key: "openPhotoSwipe",

    /**
     *
     * @param index
     * @param slides
     * @param disableAnimation
     * @param fromURL
     */
    value: function openPhotoSwipe(index, slides, disableAnimation, fromURL) {
      var _this = this;

      var pswpElement = document.querySelectorAll('.pswp')[0],
          options;

      if (slides === undefined || slides.length === 0) {
        return;
      } // define options (if needed)


      options = {
        galleryPIDs: true,
        // define gallery index (for URL)
        galleryUID: slides[0].gid,
        shareEl: slides[0].thumbnailContainer ? slides[0].thumbnailContainer.getElementsByClassName('social-share-button').length > 0 : false,
        downloadEl: slides[0].thumbnailContainer ? slides[0].thumbnailContainer.getElementsByClassName('eg-download').length > 0 : false,
        add2cartEl: slides[0].thumbnailContainer ? slides[0].thumbnailContainer.getElementsByClassName('eventgallery-add2cart').length > 0 : false,
        getThumbBoundsFn: disableAnimation ? null : function (index) {
          // See Options -> getThumbBoundsFn section of documentation for more info
          var slide = slides[index],
              thumbnail = slide.thumbnailContainer.getElementsByTagName('img')[0],
              // find thumbnail
          pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
              rect = thumbnail.getBoundingClientRect();
          var w = rect.width,
              h = rect.height,
              x,
              y,
              ratio = slide.w / slide.h;

          if (slide.h > slide.w) {
            x = rect.left;
            y = rect.top - Math.ceil((w / ratio - h) / 2) + pageYScroll;
          } else {
            x = rect.left - Math.ceil((h * ratio - w) / 2);
            y = rect.top + pageYScroll;
            w = Math.ceil(h * ratio);
          }

          return {
            x: x,
            y: y,
            w: w
          };
        },
        overlayClass: _Overlay__WEBPACK_IMPORTED_MODULE_1__.default
      }; // disable close gestures to avoid trouble with the add2cart dialog.

      options.pinchToClose = !options.add2cartEl;
      options.closeOnVerticalDrag = !options.add2cartEl;
      options.closeOnScroll = !options.add2cartEl;

      if (window.EventGalleryLightboxConfiguration) {
        if (parseInt(window.EventGalleryLightboxConfiguration.navigationFadeDelay) > 0) {
          options.timeToIdle = parseInt(window.EventGalleryLightboxConfiguration.navigationFadeDelay);
          options.timeToIdleOutside = parseInt(window.EventGalleryLightboxConfiguration.navigationFadeDelay);
        }
      } // PhotoSwipe opened from URL


      if (fromURL) {
        if (options.galleryPIDs) {
          index = parseInt(index, 10); // parse real index when custom PIDs are used
          // http://photoswipe.com/documentation/faq.html#custom-pid-in-url

          for (var j = 0; j < slides.length; j++) {
            if (slides[j].pid === index) {
              options.index = j;
              break;
            }
          }
        } else {
          // in URL indexes start from 1
          options.index = parseInt(index, 10) - 1;
        }
      } else {
        options.index = parseInt(index, 10);
      } // exit if index not found


      if (isNaN(options.index)) {
        return;
      }

      if (disableAnimation) {
        options.showAnimationDuration = 0;
      } // Pass data to PhotoSwipe and initialize it


      this._gallery = new _photoswipe_photoswipe__WEBPACK_IMPORTED_MODULE_3__.default(pswpElement, _photoswipe_photoswipe_ui_default_js__WEBPACK_IMPORTED_MODULE_4__.default, slides, options);

      this._gallery.init();

      this.initSlideShow();
      this._isOpen = true;

      this._gallery.listen('close', function () {
        return _this._isOpen = false;
      });

      this._gallery.listen('afterChange', function () {
        document.dispatchEvent(_Polyfill__WEBPACK_IMPORTED_MODULE_0__.default.createNewEvent('eventgallery-lightbox-changed'));
      });

      document.dispatchEvent(_Polyfill__WEBPACK_IMPORTED_MODULE_0__.default.createNewEvent('eventgallery-lightbox-opened'));
    }
  }, {
    key: "initPhotoSwipe",
    value: function initPhotoSwipe() {
      PhotoSwipeGallery.appendControlls();

      this._registerClickEvents(); // Parse URL and open gallery if it contains #&pid=3&gid=1


      var hashData = PhotoSwipeGallery.parseHash();

      if (hashData.pid && hashData.gid) {
        this.openPhotoSwipe(hashData.pid, this.getGalleries().get(hashData.gid), true, true);
      }
    }
  }, {
    key: "_registerClickEvents",
    value: function _registerClickEvents() {
      var _this2 = this;

      // loop through all gallery elements and bind events
      var galleries = this.getGalleries();

      var _iterator2 = _createForOfIteratorHelper(galleries.values()),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var gallery = _step2.value;

          for (var i = 0, l = gallery.length; i < l; i++) {
            gallery[i].thumbnailContainer.onclick = function (e) {
              _this2.onThumbnailsClick(e);
            };
          }
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }
    }
    /**
     * grabs the current slide from the lightbox
     * @returns PhotoSwipeGallerySlide
     */

  }, {
    key: "getCurrentSlide",
    value: function getCurrentSlide() {
      return this._gallery.currItem;
    }
    /**
     * Returns the index if the current item in the lightbox
     *
     * @returns {int}
     */

  }, {
    key: "getCurrentIndex",
    value: function getCurrentIndex() {
      return this._gallery.getCurrentIndex();
    }
    /**
     * reinitiate the lightbox. Register the click events for existing and new elements.
     */

  }, {
    key: "reload",
    value: function reload() {
      this._registerClickEvents();
    }
    /**
     * reports back if the lightbox is currently open
     * @returns {boolean}
     */

  }, {
    key: "isOpen",
    value: function isOpen() {
      return this._isOpen;
    }
    /**
     *
     * @param afterChangeFunction
     */

  }, {
    key: "setAfterChangeEventListener",
    value: function setAfterChangeEventListener(afterChangeFunction) {
      this._gallery.listen('afterChange', afterChangeFunction);
    }
    /**
     * jump to a specific slide.
     * @param index
     */

  }, {
    key: "gotoSlide",
    value: function gotoSlide(index) {
      this._gallery.goTo(index);
    }
    /**
     * Adds a slide to the slide deck of the current _gallery
     * @param slide PhotoSwipeGallerySlide
     */

  }, {
    key: "pushSlide",
    value: function pushSlide(slide) {
      this._gallery.items.push(slide);
    }
    /**
     * removes a slide from the slide deck of the current _gallery
     * @returns {PhotoSwipeGallerySlide}
     */

  }, {
    key: "popSlide",
    value: function popSlide() {
      return this._gallery.items.pop();
    }
    /**
     * reloads a slide after a modification
     */

  }, {
    key: "reloadSlide",
    value: function reloadSlide() {
      this._gallery.invalidateCurrItems();

      this._gallery.updateSize(true);
    }
    /**
     * switch to the next slide
     */

  }, {
    key: "nextSlide",
    value: function nextSlide() {
      this._gallery.next();
    }
    /**
     * Fire up the slide show stuff
     */

  }, {
    key: "initSlideShow",
    value: function initSlideShow() {
      if (!window.EventGalleryLightboxConfiguration) {
        return;
      }

      if (!window.EventGalleryLightboxConfiguration.doUseSlideshow) {
        return;
      }

      document.getElementsByClassName(PSW_CONTROLS_SLIDESHOW_BUTTON_ELEMENT_CLASS)[0].classList.remove(PSW_HIDE_CLASS);
      var slideShow = new _SlideShow__WEBPACK_IMPORTED_MODULE_2__.default(this);
      slideShow.setDelay(window.EventGalleryLightboxConfiguration.slideshowSpeed);

      if (window.EventGalleryLightboxConfiguration.doUseAutoplay) {
        slideShow.toggleSlideShowState();
      }
    }
    /**
     * make the listen function of PhotoSwipe available
     *
     * @param eventName
     * @param fn
     */

  }, {
    key: "listen",
    value: function listen(eventName, fn) {
      this._gallery.listen(eventName, fn);
    }
  }], [{
    key: "getThumbnailContainers",
    value: function getThumbnailContainers() {
      var thumbnailContainer = document.querySelectorAll('a[data-eg-lightbox]'); // don't add images from the clone slides. They are not clickable but will add duplicates to the lightbox => #818

      return Array.from(thumbnailContainer).filter(function (tc) {
        var parents = (0,_common_js_Helpers__WEBPACK_IMPORTED_MODULE_5__.getParents)(tc);
        var thumbnailContainerIsAllowed = true;
        parents.forEach(function (parent) {
          if (thumbnailContainerIsAllowed && parent.classList.contains('glide__slide--clone')) {
            thumbnailContainerIsAllowed = false;
          }
        });
        return thumbnailContainerIsAllowed;
      });
    }
  }, {
    key: "translate",
    value: function translate(input) {
      var result = input;

      if (window.EventGalleryLightboxConfiguration) {
        result = result.replace('{{CLOSE}}', EventGalleryLightboxConfiguration.KEY_CLOSE);
        result = result.replace('{{SHARE}}', EventGalleryLightboxConfiguration.KEY_SHARE);
        result = result.replace('{{DOWNLOAD}}', EventGalleryLightboxConfiguration.KEY_DOWNLOAD);
        result = result.replace('{{BUY}}', EventGalleryLightboxConfiguration.KEY_BUY);
        result = result.replace('{{ZOOM}}', EventGalleryLightboxConfiguration.KEY_ZOOM);
        result = result.replace('{{PREVIOUS}}', EventGalleryLightboxConfiguration.KEY_PREVIOUS);
        result = result.replace('{{NEXT}}', EventGalleryLightboxConfiguration.KEY_NEXT);
        result = result.replace('{{FULLSCREEN}}', EventGalleryLightboxConfiguration.KEY_FULLSCREEN);
        result = result.replace('{{PLAYSLIDESHOW}}', EventGalleryLightboxConfiguration.KEY_PLAYSLIDESHOW);
        result = result.replace('{{PAUSESLIDESHOW}}', EventGalleryLightboxConfiguration.KEY_PAUSESLIDESHOW);
      }

      return result;
    }
    /**
     * append the photoswipe controls to the body element. If there is already a control element, we delete it.
     */

  }, {
    key: "appendControlls",
    value: function appendControlls() {
      var controllElements = document.getElementsByClassName(PSWP_CONTROLS_MAIN_ELEMENT_CLASS);

      for (var i = 0; i < controllElements.length; i++) {
        _Polyfill__WEBPACK_IMPORTED_MODULE_0__.default.removeHtmlElementNode(controllElements[i]);
      }

      var div = document.createElement('div');
      div.innerHTML = PhotoSwipeGallery.translate(PSWP_CONTROLS);
      document.getElementsByTagName('body')[0].appendChild(div);
    }
  }, {
    key: "closest",
    value: function closest(el, fn) {
      return el && (fn(el) ? el : PhotoSwipeGallery.closest(el.parentNode, fn));
    }
  }, {
    key: "parseHash",
    value: function parseHash() {
      return PhotoSwipeGallery._parseHashString(window.location.hash.substring(1));
    }
    /**
     * splits a hash value into its elements. returns an empty object if there is nothing in
     */

  }, {
    key: "_parseHashString",
    value: function _parseHashString(hash) {
      var params = {};

      if (hash.length < 5) {
        return params;
      }

      var vars = hash.split('&');

      for (var i = 0; i < vars.length; i++) {
        if (!vars[i]) {
          continue;
        }

        var pair = vars[i].split('=');

        if (pair.length < 2) {
          continue;
        }

        params[pair[0]] = pair[1];
      }

      return params;
    }
  }, {
    key: "parseThumbnailElement",

    /**
     *
     * @param thumbnailContainer Node
     * @returns PhotoSwipeGallerySlide
     */
    value: function parseThumbnailElement(thumbnailContainer) {
      var item, imgEl, height, width, pid, gid; // include only element nodes

      if (thumbnailContainer.nodeType !== 1) {
        return null;
      }

      imgEl = thumbnailContainer.getElementsByTagName('IMG')[0];

      if (imgEl === undefined) {
        return null;
      }

      height = thumbnailContainer.getAttribute('data-height');
      width = thumbnailContainer.getAttribute('data-width');
      pid = thumbnailContainer.getAttribute('data-pid');
      gid = thumbnailContainer.getAttribute('data-gid');

      if (height === null || width === null || pid === null) {
        return null;
      } // create slide object


      item = new _PhotoSwipeGallerySlide_js__WEBPACK_IMPORTED_MODULE_6__.default();
      item.src = thumbnailContainer.getAttribute('href');
      item.w = parseInt(width, 10);
      item.h = parseInt(height, 10);
      item.title = decodeURIComponent(thumbnailContainer.getAttribute('data-title'));
      item.pid = parseInt(pid, 10);
      item.gid = gid;
      item.thumbnailContainer = thumbnailContainer; // save link to element for getThumbBoundsFn

      return item;
    }
  }]);

  return PhotoSwipeGallery;
}();
/* override handling of Esc key to stop slideshow on first esc (note Esc to leave fullscreen never gets here) */

/*$(document).keydown(function(e) {
    if (e.altKey || e.ctrlKey || e.shiftKey || e.metaKey) return;
    if ((e.key === "Escape" || e.which == 27 ) && !!lightBox) {
        if (e.preventDefault)  e.preventDefault();
        else  e.returnValue = false;
        if (ssRunning) {
            setSlideshowState(ssButtonClass, false);
        } else {
            lightBox.close();
        }
    }
});
*/




/***/ }),

/***/ "./frontend/js/PhotoSwipeGallerySlide.js":
/*!***********************************************!*\
  !*** ./frontend/js/PhotoSwipeGallerySlide.js ***!
  \***********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ PhotoSwipeGallerySlide
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var PhotoSwipeGallerySlide = /*#__PURE__*/function () {
  function PhotoSwipeGallerySlide() {
    _classCallCheck(this, PhotoSwipeGallerySlide);

    this.w = 0;
    this.h = 0;
    this.src = '';
    this.title = '';
    this.pid = '';
    this.gid = '';
    this.thumbnailContainer = null;
    this.msrc = '';
  }

  _createClass(PhotoSwipeGallerySlide, [{
    key: "hash",
    value: function hash() {
      return this.gid + this.src;
    }
  }]);

  return PhotoSwipeGallerySlide;
}();



/***/ }),

/***/ "./frontend/js/SlideShow.js":
/*!**********************************!*\
  !*** ./frontend/js/SlideShow.js ***!
  \**********************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ SlideShow
/* harmony export */ });
/* harmony import */ var _PhotoSwipeGallery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PhotoSwipeGallery */ "./frontend/js/PhotoSwipeGallery.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


/**
 * Builds a slide show on top of PhotoSwipe.
 */

var SlideShow = /*#__PURE__*/function () {
  /**
   *
   * @param photoSwipeGallery PhotoSwipeGallery
   */
  function SlideShow(photoSwipeGallery) {
    var _this = this;

    _classCallCheck(this, SlideShow);

    this._photoSwipeGallery = photoSwipeGallery;
    this._SlideShow_Running = false;
    this._currentTimer = null;
    this._SlideShow_Delay = 2000
    /*ms*/
    ;
    this._SlideShow_Button = document.getElementsByClassName('pswp__button--playpause')[0];

    var interactionHandler = function interactionHandler(e) {
      e.preventDefault();
      e.stopPropagation();
      return _this.toggleSlideShowState();
    }; // take care about both click and touch.


    this._SlideShow_Button.onclick = interactionHandler;
    this._SlideShow_Button.ontouchstart = interactionHandler;

    this._photoSwipeGallery.listen('afterChange', function () {
      _this._planNextSwitch(false);
    });

    this._photoSwipeGallery.listen('destroy', function () {
      return _this._photoSwipeGallery = null;
    });

    this._photoSwipeGallery.listen('userInteractionHappened', function () {
      return _this._stopSlideshow();
    });

    this._photoSwipeGallery.listen('mainScrollAnimStart', function () {
      return _this._stopSlideshow();
    });

    this._adjustNavigation();
  }
  /**
   *
   * @param delay int
   */


  _createClass(SlideShow, [{
    key: "setDelay",
    value: function setDelay(delay) {
      this._SlideShow_Delay = delay;
    }
    /**
     * switches the slide show on/off depending on the current state
     */

  }, {
    key: "toggleSlideShowState",
    value: function toggleSlideShowState() {
      if (this._SlideShow_Running) {
        this._stopSlideshow();
      } else {
        this._startSlideshow();
      }
    }
  }, {
    key: "_stopSlideshow",
    value: function _stopSlideshow() {
      this._SlideShow_Running = false;

      this._adjustNavigation();
    }
  }, {
    key: "_startSlideshow",
    value: function _startSlideshow() {
      this._SlideShow_Running = true;

      this._planNextSwitch(true);

      this._adjustNavigation();
    }
    /**
     * make sure the navigation displays the current slide show state.
     */

  }, {
    key: "_adjustNavigation",
    value: function _adjustNavigation() {
      this._SlideShow_Button.classList.remove(this._SlideShow_Running ? "play" : "pause");

      this._SlideShow_Button.classList.add(this._SlideShow_Running ? "pause" : "play");

      this._SlideShow_Button.setAttribute('title', this._SlideShow_Running ? this._SlideShow_Button.getAttribute('data-title-pause') : this._SlideShow_Button.getAttribute('data-title-play'));
    }
    /**
     * create the timeout for the next switch.
     *
     * @param isForTheFirstSwitch Boolean changes the switch time so the first switch can be faster
     */

  }, {
    key: "_planNextSwitch",
    value: function _planNextSwitch(isForTheFirstSwitch) {
      var _this2 = this;

      clearTimeout(this._currentTimer);
      this._currentTimer = setTimeout(function () {
        return _this2._nextSlide();
      }, isForTheFirstSwitch ? this._SlideShow_Delay / 2.0 : this._SlideShow_Delay);
    }
    /**
     * change to the next slide
     */

  }, {
    key: "_nextSlide",
    value: function _nextSlide() {
      if (this._photoSwipeGallery === null) {
        return;
      }

      if (!this._SlideShow_Running) {
        return;
      }

      this._photoSwipeGallery.nextSlide();
    }
  }]);

  return SlideShow;
}();



/***/ }),

/***/ "./frontend/js/URLHelper.js":
/*!**********************************!*\
  !*** ./frontend/js/URLHelper.js ***!
  \**********************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ URLHelper
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var URLHelper = /*#__PURE__*/function () {
  function URLHelper() {
    _classCallCheck(this, URLHelper);
  }
  /**
   * splits a URL parameter like foo=bar&1=2 into a parameter map
   *
   * @param urlParameterString
   * @returns {Map<any, any>}
   */


  _createClass(URLHelper, null, [{
    key: "parseURLParameter",
    value: function parseURLParameter(urlParameterString) {
      var pairs = urlParameterString.split('&');
      var parameters = new Map();
      pairs.forEach(function (pair) {
        var splittedPair = pair.split('=');

        if (splittedPair.length === 2) {
          parameters.set(splittedPair[0], splittedPair[1]);
        }
      });
      return parameters;
    }
    /**
     * returns a map of the query string of an full url
     *
     * @param urlSring
     * @returns {URLSearchParams}
     */

  }, {
    key: "getParameters",
    value: function getParameters(urlSring) {
      var parts = urlSring.split('?');

      if (parts.length < 2) {
        return new Map();
      }

      var queryParts = parts[1].split('#');
      return URLHelper.parseURLParameter(queryParts[0]);
    }
    /**
     * returns the url from strings like "url ('foobar.jpg')"
     *
     * @param urlString
     * @returns {*}
     */

  }, {
    key: "extractBackgroudUrl",
    value: function extractBackgroudUrl(urlString) {
      return urlString.replace(/(url\(|\)|"|')/g, '');
    }
  }]);

  return URLHelper;
}();


;

/***/ }),

/***/ "./frontend/js/glide_modules/anchor.js":
/*!*********************************************!*\
  !*** ./frontend/js/glide_modules/anchor.js ***!
  \*********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* export default binding */ __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _utils_eventshandler__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/eventshandler */ "./frontend/js/utils/eventshandler.js");

/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__(Glide, Components, Events) {
  /**
   * Instance of the binder for DOM Events.
   *
   * @type {EventsHandler}
   */
  var Binder = new _utils_eventshandler__WEBPACK_IMPORTED_MODULE_0__.default();
  /**
   * Holds preventing status of anchors.
   * If `true` redirection after click will be disabled.
   *
   * @private
   * @type {Boolean}
   */

  var prevented = false;
  var isSwiping = false;
  var Anchors = {
    /**
     * Setups a initial state of anchors component.
     *
     */
    mount: function mount() {
      /**
       * Holds collection of anchors elements.
       *
       * @private
       * @type {HTMLCollection}
       */
      this._a = Components.Html.wrapper.querySelectorAll('a,span,img');
      this.bind();
      isSwiping = false;
    },

    /**
     * Binds events to anchors inside a track.
     *
     */
    bind: function bind() {
      Binder.on('click', Components.Html.wrapper, this.click, true);
    },

    /**
     * Unbinds events attached to anchors inside a track.
     *
     */
    unbind: function unbind() {
      Binder.off('click', Components.Html.wrapper);
    },

    /**
     * Handler for click event. Prevents clicks when glide is in `prevent` status.
     *
     * @param  {Object} event
     */
    click: function click(event) {
      if (prevented) {
        event.stopPropagation();
        event.preventDefault();
      }
    },

    /**
     * Detaches anchors click event inside glide.
     *
     * @return {self}
     */
    detach: function detach() {
      prevented = true;
      return this;
    },

    /**
     * Attaches anchors click events inside glide.
     *
     * @return {self}
     */
    attach: function attach() {
      prevented = false;
      return this;
    }
  };
  Object.defineProperty(Anchors, 'items', {
    /**
     * Gets collection of the arrows HTML elements.
     *
     * @return {HTMLElement[]}
     */
    get: function get() {
      return Anchors._a;
    }
  });
  /**
   * Detach anchors inside slides:
   * - on swiping, so they won't redirect to its `href` attributes
   */

  Events.on('swipe.move', function () {
    Anchors.detach();
  });
  /**
   * Attach anchors inside slides:
   * - after swiping and transitions ends, so they can redirect after click again
   */

  Events.on('swipe.end', function () {
    Components.Transition.after(function () {
      Anchors.attach();
    });
  });
  /**
   * Unbind anchors inside slides:
   * - on destroying, to bring anchors to its initial state
   */

  Events.on('destroy', function () {
    Anchors.attach();
    Anchors.unbind();
    Binder.destroy();
  });
  return Anchors;
}

/***/ }),

/***/ "./frontend/js/slider/SliderOptions.js":
/*!*********************************************!*\
  !*** ./frontend/js/slider/SliderOptions.js ***!
  \*********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ SliderOptions
/* harmony export */ });
/* harmony import */ var _utils_camelCaseConverter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/camelCaseConverter */ "./frontend/js/utils/camelCaseConverter.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


var prefix = "data-slider-";

var SliderOptions = /*#__PURE__*/function () {
  function SliderOptions(element) {
    _classCallCheck(this, SliderOptions);

    this.element = element;
    this.options = Object.assign({
      autoplay: false,
      slidesElementsSelector: '',
      numberOfRowsPerSlide: 1,
      showNav: 'true'
    }, SliderOptions._parseOptions(element));
  }
  /**
   *
   * @param element HTMLElement
   * @private
   */


  _createClass(SliderOptions, [{
    key: "getAutoPlay",
    value: function getAutoPlay() {
      if (this.options.autoplay === false) {
        return false;
      }

      return parseInt(this.options.autoplay);
    }
  }, {
    key: "getSlidesElementsSelector",
    value: function getSlidesElementsSelector() {
      return this.options.slidesElementsSelector;
    }
  }, {
    key: "doShowNav",
    value: function doShowNav() {
      return this.options.showNav === 'true';
    }
  }, {
    key: "getNumberOfRowsPerSlide",
    value: function getNumberOfRowsPerSlide() {
      return parseInt(this.options.numberOfRowsPerSlide);
    }
  }], [{
    key: "_parseOptions",
    value: function _parseOptions(element) {
      var options = {};
      var attributes = element.attributes;

      for (var i = 0; i < attributes.length; i++) {
        if (attributes[i].name.indexOf(prefix) === 0) {
          options[_utils_camelCaseConverter__WEBPACK_IMPORTED_MODULE_0__.default.toCamelCase(attributes[i].name.replace(prefix, ''))] = attributes[i].value;
        }
      }

      return options;
    }
  }]);

  return SliderOptions;
}();



/***/ }),

/***/ "./frontend/js/slider/SliderStarter.js":
/*!*********************************************!*\
  !*** ./frontend/js/slider/SliderStarter.js ***!
  \*********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ SliderStarter
/* harmony export */ });
/* harmony import */ var _glide_modules_anchor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../glide_modules/anchor */ "./frontend/js/glide_modules/anchor.js");
/* harmony import */ var _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @glidejs/glide/dist/glide.modular.esm */ "./node_modules/@glidejs/glide/dist/glide.modular.esm.js");
/* harmony import */ var _SliderTransformator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SliderTransformator */ "./frontend/js/slider/SliderTransformator.js");
/* harmony import */ var _SliderOptions__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./SliderOptions */ "./frontend/js/slider/SliderOptions.js");
/* harmony import */ var _utils_ElementSize__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../utils/ElementSize */ "./frontend/js/utils/ElementSize.js");
/* harmony import */ var _EventgalleryLazyload__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../EventgalleryLazyload */ "./frontend/js/EventgalleryLazyload.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }








var SliderStarter = /*#__PURE__*/function () {
  function SliderStarter(sourceGroupElement) {
    _classCallCheck(this, SliderStarter);

    this.sourceGroupElement = sourceGroupElement;
    this.sliderTransformator = null;
  }

  _createClass(SliderStarter, [{
    key: "start",
    value: function start() {
      this.sliderOptions = SliderStarter._loadOptions(this.sourceGroupElement);
      var sourceElementSelector = this.sliderOptions.getSlidesElementsSelector();
      var autoplay = this.sliderOptions.getAutoPlay();
      var doShowNav = this.sliderOptions.doShowNav();
      var numberOfItemsPerSlide = _utils_ElementSize__WEBPACK_IMPORTED_MODULE_5__.default.calclateNumberOfFittingItemsPerSlide(this.sourceGroupElement, this.sourceGroupElement.querySelector(sourceElementSelector), this.sliderOptions.getNumberOfRowsPerSlide());

      if (null == this.sliderTransformator) {
        this.sliderTransformator = new _SliderTransformator__WEBPACK_IMPORTED_MODULE_2__.default(this.sourceGroupElement, sourceElementSelector, doShowNav);
      }

      var rootElement = this.sliderTransformator.transform(numberOfItemsPerSlide);

      if (rootElement === null) {
        return;
      }

      _EventgalleryLazyload__WEBPACK_IMPORTED_MODULE_4__.default.watchImages();
      var glide = new _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__.default(rootElement, {
        type: 'carousel',
        perView: 1,
        gap: 15,
        keyboard: false,
        autoplay: autoplay
      });
      glide.mount({
        Swipe: _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__.Swipe,
        Controls: _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__.Controls,
        Breakpoints: _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__.Breakpoints,
        Autoplay: _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__.Autoplay,
        Anchor: _glide_modules_anchor__WEBPACK_IMPORTED_MODULE_0__.default,
        Images: _glidejs_glide_dist_glide_modular_esm__WEBPACK_IMPORTED_MODULE_1__.Images
      });
    }
  }], [{
    key: "_loadOptions",
    value: function _loadOptions(element) {
      return new _SliderOptions__WEBPACK_IMPORTED_MODULE_3__.default(element);
    }
  }]);

  return SliderStarter;
}();



/***/ }),

/***/ "./frontend/js/slider/SliderTransformator.js":
/*!***************************************************!*\
  !*** ./frontend/js/slider/SliderTransformator.js ***!
  \***************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ SliderTransformator
/* harmony export */ });
/* harmony import */ var _Polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Polyfill */ "./frontend/js/Polyfill.ts");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


var sliderRootSelector = '.glide';
var sliderGroupSelector = '.glide__slides';
var basicMarkup = "\n<div class=\"glide\">\n    <div class=\"glide__track\" data-glide-el=\"track\">\n        <ul class=\"glide__slides\">            \n        </ul>\n    </div>\n    <div class=\"glide__arrows\" data-glide-el=\"controls\">\n        <button class=\"glide__arrow glide__arrow--left\" data-glide-dir=\"<\">prev</button>\n        <button class=\"glide__arrow glide__arrow--right\" data-glide-dir=\">\">next</button>\n    </div>\n</div>";

var SliderTransformator = /*#__PURE__*/function () {
  function SliderTransformator(sourceGroupElement, sourceElementSelector, doShowNav) {
    _classCallCheck(this, SliderTransformator);

    this.elementSelector = sourceElementSelector;
    this.sourceGroupElement = sourceGroupElement;
    this.doShowNav = doShowNav;
    this.sourceElements = this.getSourceElements();
  }

  _createClass(SliderTransformator, [{
    key: "getSourceElements",
    value: function getSourceElements() {
      if (this.sourceGroupElement === null) {
        return null;
      }

      return this.sourceGroupElement.querySelectorAll(this.elementSelector);
    }
  }, {
    key: "transform",
    value: function transform(numberOfItemsPerSlide) {
      if (this.sourceGroupElement === null || this.sourceElements === null) {
        return null;
      }

      if (this.sourceElements.length === 0) {
        return null;
      } // cleanup


      var sliderRoot = this.sourceGroupElement.querySelector(sliderRootSelector);

      if (sliderRoot !== null) {
        sliderRoot.remove();
      } // transformation


      var sliderMarkup = document.createRange().createContextualFragment(basicMarkup);

      if (!this.doShowNav) {
        var controlElement = sliderMarkup.querySelector('.glide__arrows');
        _Polyfill__WEBPACK_IMPORTED_MODULE_0__.default.removeHtmlElementNode(controlElement);
      }

      var sliderGroupElement = sliderMarkup.querySelector(sliderGroupSelector);
      var currentSliderElement = null;

      for (var index = 0; index < this.sourceElements.length; index++) {
        var element = this.sourceElements[index];

        if (index % numberOfItemsPerSlide === 0) {
          currentSliderElement = document.createElement('li');
          currentSliderElement.className = 'glide__slide';
          sliderGroupElement.appendChild(currentSliderElement);
        }

        currentSliderElement.appendChild(element);
      }

      this.sourceGroupElement.appendChild(sliderMarkup);
      return this.sourceGroupElement.querySelector(sliderRootSelector);
    }
  }]);

  return SliderTransformator;
}();



/***/ }),

/***/ "./frontend/js/utils/ElementSize.js":
/*!******************************************!*\
  !*** ./frontend/js/utils/ElementSize.js ***!
  \******************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ ElementSize
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var ElementSize = /*#__PURE__*/function () {
  function ElementSize() {
    _classCallCheck(this, ElementSize);
  }

  _createClass(ElementSize, null, [{
    key: "getOuterWidth",

    /**
     *
     * @param element
     * @returns float
     */
    value: function getOuterWidth(element) {
      var domRect = element.getBoundingClientRect();
      var computedStyle = getComputedStyle(element);
      var marginLeft = parseFloat(computedStyle.marginLeft);
      var marginRight = parseFloat(computedStyle.marginRight);
      return domRect.width + marginLeft + marginRight;
    }
    /**
     * Tries to find out, how many elements we can fit into the container so
     * they do not wrap.
     *
     * @param containerElement
     * @param element
     * @param numberOfRows
     * @returns {number}
     */

  }, {
    key: "calclateNumberOfFittingItemsPerSlide",
    value: function calclateNumberOfFittingItemsPerSlide(containerElement, element, numberOfRows) {
      if (null == element || containerElement == null) {
        return 1;
      }

      var domRect = containerElement.getBoundingClientRect();
      var numberOfItemsPerSlide = Math.floor(domRect.width / ElementSize.getOuterWidth(element)) * numberOfRows;

      if (numberOfItemsPerSlide < 1) {
        numberOfItemsPerSlide = 1 * numberOfRows;
      }

      return numberOfItemsPerSlide;
    }
  }]);

  return ElementSize;
}();



/***/ }),

/***/ "./frontend/js/utils/camelCaseConverter.js":
/*!*************************************************!*\
  !*** ./frontend/js/utils/camelCaseConverter.js ***!
  \*************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ CamelCaseConverter
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var CamelCaseConverter = /*#__PURE__*/function () {
  function CamelCaseConverter() {
    _classCallCheck(this, CamelCaseConverter);
  }

  _createClass(CamelCaseConverter, null, [{
    key: "toCamelCase",
    value: function toCamelCase(str) {
      return str.replace(/-([a-z])/g, function (m, w) {
        return w.toUpperCase();
      });
    }
  }]);

  return CamelCaseConverter;
}();



/***/ }),

/***/ "./frontend/js/utils/eventshandler.js":
/*!********************************************!*\
  !*** ./frontend/js/utils/eventshandler.js ***!
  \********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* binding */ EventsHandler
/* harmony export */ });
/* harmony import */ var _units__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./units */ "./frontend/js/utils/units.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var EventsHandler = /*#__PURE__*/function () {
  /**
   * Construct a EventsHandler instance.
   */
  function EventsHandler() {
    var listeners = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, EventsHandler);

    this.listeners = listeners;
  }
  /**
   * Adds events listeners to arrows HTML elements.
   *
   * @param  {String|Array} events
   * @param  {NodeList|Element|Window|Document} el
   * @param  {Function} closure
   * @param  {boolean} capture
   */


  _createClass(EventsHandler, [{
    key: "on",
    value: function on(events, el, closure) {
      var _this = this;

      var capture = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;

      if ((0,_units__WEBPACK_IMPORTED_MODULE_0__.isString)(events)) {
        events = [events];
      }

      if (!(0,_units__WEBPACK_IMPORTED_MODULE_0__.isNodeList)(el) && !(0,_units__WEBPACK_IMPORTED_MODULE_0__.isArray)(el)) {
        el = [el];
      }

      events.forEach(function (event) {
        _this.listeners[event] = {
          'closure': closure,
          'capture': capture
        };

        for (var i = 0; i < el.length; i++) {
          el[i].addEventListener(event, _this.listeners[event].closure, _this.listeners[event].capture);
        }
      });
    }
    /**
     * Removes event listeners from arrows HTML elements.
     *
     * @param  {String|Array} events
     * @param  {NodeList|Element|Window|Document} el
     */

  }, {
    key: "off",
    value: function off(events, el) {
      var _this2 = this;

      if ((0,_units__WEBPACK_IMPORTED_MODULE_0__.isString)(events)) {
        events = [events];
      }

      if (!(0,_units__WEBPACK_IMPORTED_MODULE_0__.isNodeList)(el) && !(0,_units__WEBPACK_IMPORTED_MODULE_0__.isArray)(el)) {
        el = [el];
      }

      events.forEach(function (event) {
        for (var i = 0; i < el.length; i++) {
          var listener = _this2.listeners[event];

          if (listener === undefined) {
            continue;
          }

          el[i].removeEventListener(event, listener.closure, listener.capture);
        }
      });
    }
    /**
     * Destroy collected listeners.
     *
     */

  }, {
    key: "destroy",
    value: function destroy() {
      delete this.listeners;
    }
  }]);

  return EventsHandler;
}();



/***/ }),

/***/ "./frontend/js/utils/units.js":
/*!************************************!*\
  !*** ./frontend/js/utils/units.js ***!
  \************************************/
/*! namespace exports */
/*! export isArray [provided] [no usage info] [missing usage info prevents renaming] */
/*! export isNodeList [provided] [no usage info] [missing usage info prevents renaming] */
/*! export isString [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "isString": () => /* binding */ isString,
/* harmony export */   "isArray": () => /* binding */ isArray,
/* harmony export */   "isNodeList": () => /* binding */ isNodeList
/* harmony export */ });
/**
 * Indicates whether the specified value is a string.
 *
 * @param  {*}   value
 * @return {Boolean}
 */
function isString(value) {
  return typeof value === 'string';
}
function isArray(value) {
  return Array.isArray(value);
}
function isNodeList(value) {
  return NodeList.prototype.isPrototypeOf(value);
}

/***/ }),

/***/ "./photoswipe/photoswipe-ui-default.js":
/*!*********************************************!*\
  !*** ./photoswipe/photoswipe-ui-default.js ***!
  \*********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* export default binding */ __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/*! PhotoSwipe Default UI - 4.1.3 - 2019-01-08
* http://photoswipe.com
* Copyright (c) 2019 Dmitry Semenov; */

/**
*
* UI on top of main sliding area (caption, arrows, close button, etc.).
* Built just using public methods/properties of PhotoSwipe.
* 
*/
/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__(pswp, framework) {
  var ui = this;

  var _overlayUIUpdated = false,
      _controlsVisible = true,
      _fullscrenAPI,
      _controls,
      _captionContainer,
      _fakeCaptionContainer,
      _indexIndicator,
      _shareButton,
      _shareModal,
      _add2cartButton,
      _add2cartOverlay,
      _shareModalHidden = true,
      _add2cartModalHidden = true,
      _initalCloseOnScrollValue,
      _isIdle,
      _listen,
      _loadingIndicator,
      _loadingIndicatorHidden,
      _loadingIndicatorTimeout,
      _galleryHasOneSlide,
      _options,
      _defaultUIOptions = {
    barsSize: {
      top: 44,
      bottom: 'auto'
    },
    closeElClasses: ['item', 'caption', 'zoom-wrap', 'ui', 'top-bar'],
    timeToIdle: 4000,
    timeToIdleOutside: 1000,
    loadingIndicatorDelay: 1000,
    // 2s
    addCaptionHTMLFn: function addCaptionHTMLFn(item, captionEl
    /*, isFake */
    ) {
      if (!item.title) {
        captionEl.children[0].innerHTML = '';
        return false;
      }

      captionEl.children[0].innerHTML = item.title;
      return true;
    },
    closeEl: true,
    captionEl: true,
    fullscreenEl: true,
    zoomEl: true,
    shareEl: true,
    downloadEl: true,
    counterEl: true,
    arrowEl: true,
    preloaderEl: true,
    tapToClose: false,
    tapToToggleControls: true,
    clickToCloseNonZoomable: true,
    shareButtons: [{
      id: 'facebook',
      label: 'Share on Facebook',
      url: 'https://www.facebook.com/sharer/sharer.php?u={{url}}'
    }, {
      id: 'twitter',
      label: 'Tweet',
      url: 'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'
    }, {
      id: 'pinterest',
      label: 'Pin it',
      url: 'http://www.pinterest.com/pin/create/button/' + '?url={{url}}&media={{image_url}}&description={{text}}'
    }, {
      id: 'download',
      label: 'Download image',
      url: '{{raw_image_url}}',
      download: true
    }],
    getImageURLForShare: function getImageURLForShare()
    /* shareButtonData */
    {
      return pswp.currItem.src || '';
    },
    getPageURLForShare: function getPageURLForShare()
    /* shareButtonData */
    {
      return window.location.href;
    },
    getTextForShare: function getTextForShare()
    /* shareButtonData */
    {
      return pswp.currItem.title || '';
    },
    indexIndicatorSep: ' / ',
    fitControlsWidth: 1200
  },
      _blockControlsTap,
      _blockControlsTapTimeout;

  var _onControlsTap = function _onControlsTap(e) {
    if (_blockControlsTap) {
      return true;
    }

    e = e || window.event;

    if (_options.timeToIdle && _options.mouseUsed && !_isIdle) {
      // reset idle timer
      _onIdleMouseMove();
    }

    var target = e.target || e.srcElement,
        uiElement,
        clickedClass = target.getAttribute('class') || '',
        found;

    for (var i = 0; i < _uiElements.length; i++) {
      uiElement = _uiElements[i];

      if (uiElement.onTap && clickedClass.indexOf('pswp__' + uiElement.name) > -1) {
        uiElement.onTap();
        found = true;
      }
    }

    if (found) {
      if (e.stopPropagation) {
        e.stopPropagation();
      }

      _blockControlsTap = true; // Some versions of Android don't prevent ghost click event 
      // when preventDefault() was called on touchstart and/or touchend.
      // 
      // This happens on v4.3, 4.2, 4.1, 
      // older versions strangely work correctly, 
      // but just in case we add delay on all of them)	

      var tapDelay = framework.features.isOldAndroid ? 600 : 30;
      _blockControlsTapTimeout = setTimeout(function () {
        _blockControlsTap = false;
      }, tapDelay);
    }
  },
      _fitControlsInViewport = function _fitControlsInViewport() {
    return !pswp.likelyTouchDevice || _options.mouseUsed || screen.width > _options.fitControlsWidth;
  },
      _togglePswpClass = function _togglePswpClass(el, cName, add) {
    framework[(add ? 'add' : 'remove') + 'Class'](el, 'pswp__' + cName);
  },
      // add class when there is just one item in the gallery
  // (by default it hides left/right arrows and 1ofX counter)
  _countNumItems = function _countNumItems() {
    var hasOneSlide = _options.getNumItemsFn() === 1;

    if (hasOneSlide !== _galleryHasOneSlide) {
      _togglePswpClass(_controls, 'ui--one-slide', hasOneSlide);

      _galleryHasOneSlide = hasOneSlide;
    }
  },
      _toggleShareModalClass = function _toggleShareModalClass() {
    _togglePswpClass(_shareModal, 'share-modal--hidden', _shareModalHidden);
  },
      _toggleShareModal = function _toggleShareModal() {
    _shareModalHidden = !_shareModalHidden;

    if (!_shareModalHidden) {
      _toggleShareModalClass();

      setTimeout(function () {
        if (!_shareModalHidden) {
          framework.addClass(_shareModal, 'pswp__share-modal--fade-in');
        }
      }, 30);
    } else {
      framework.removeClass(_shareModal, 'pswp__share-modal--fade-in');
      setTimeout(function () {
        if (_shareModalHidden) {
          _toggleShareModalClass();
        }
      }, 300);
    }

    if (!_shareModalHidden) {
      _updateShareURLs();
    }

    return false;
  },
      _toggleAdd2cartModal = function _toggleAdd2cartModal() {
    _add2cartModalHidden = !_add2cartModalHidden;

    if (!_add2cartModalHidden) {
      if (_fullscrenAPI.isFullscreen()) {
        _fullscrenAPI.exit();
      }

      _add2cartOverlay = new _options.overlayClass();

      _add2cartOverlay.onClosed = function () {
        if (!_add2cartModalHidden) {
          _toggleAdd2cartModal();
        }
      };
    } else {
      _add2cartOverlay.closeOverlay();
    }

    if (!_add2cartModalHidden) {
      _updateAdd2cartContent();
    }

    return false;
  },
      _openWindowPopup = function _openWindowPopup(e) {
    e = e || window.event;
    var target = e.target || e.srcElement;
    pswp.shout('shareLinkClick', e, target);

    if (!target.href) {
      return false;
    }

    if (target.hasAttribute('download')) {
      return true;
    }

    window.open(target.href, 'pswp_share', 'scrollbars=yes,resizable=yes,toolbar=no,' + 'location=yes,width=550,height=420,top=100,left=' + (window.screen ? Math.round(screen.width / 2 - 275) : 100));

    if (!_shareModalHidden) {
      _toggleShareModal();
    }

    return false;
  },

  /**
   * EVENT GALLERY CUSTOMIZATION
   * @private
   */
  _updateShareURLs = function _updateShareURLs() {
    var sharingButtons = pswp.currItem.thumbnailContainer.getElementsByClassName('social-share-button');

    if (sharingButtons.length > 0) {
      var sharingButton = sharingButtons[0];
      _shareModal.children[0].innerHTML = '<a><i class="egfa egfa-2x egfa-cog egfa-spin"></i></a>';
      Eventgallery.jQuery(_shareModal.children[0]).load(sharingButton.getAttribute('data-link'));
    }

    _shareModal.children[0].onclick = function (e) {
      if (!_shareModalHidden) {
        _toggleShareModal();
      }
    };
  },
      _updateAdd2cartContent = function _updateAdd2cartContent() {
    var add2cartButtons = pswp.currItem.thumbnailContainer.getElementsByClassName('eventgallery-add2cart');

    if (add2cartButtons.length > 0) {
      var add2cartButton = add2cartButtons[0];
      var url = EventGalleryCartConfiguration.add2carturl + '&' + add2cartButton.getAttribute('data-id');

      _add2cartOverlay.openOverlay(url);
    }
  },
      _hasCloseClass = function _hasCloseClass(target) {
    for (var i = 0; i < _options.closeElClasses.length; i++) {
      if (framework.hasClass(target, 'pswp__' + _options.closeElClasses[i])) {
        return true;
      }
    }
  },
      _idleInterval,
      _idleTimer,
      _idleIncrement = 0,
      _onIdleMouseMove = function _onIdleMouseMove() {
    clearTimeout(_idleTimer);
    _idleIncrement = 0;

    if (_isIdle) {
      ui.setIdle(false);
    }
  },
      _onMouseLeaveWindow = function _onMouseLeaveWindow(e) {
    e = e ? e : window.event;
    var from = e.relatedTarget || e.toElement;

    if (!from || from.nodeName === 'HTML') {
      clearTimeout(_idleTimer);
      _idleTimer = setTimeout(function () {
        ui.setIdle(true);
      }, _options.timeToIdleOutside);
    }
  },
      _setupFullscreenAPI = function _setupFullscreenAPI() {
    if (_options.fullscreenEl && !framework.features.isOldAndroid) {
      if (!_fullscrenAPI) {
        _fullscrenAPI = ui.getFullscreenAPI();
      }

      if (_fullscrenAPI) {
        framework.bind(document, _fullscrenAPI.eventK, ui.updateFullscreen);
        ui.updateFullscreen();
        framework.addClass(pswp.template, 'pswp--supports-fs');
      } else {
        framework.removeClass(pswp.template, 'pswp--supports-fs');
      }
    }
  },
      _setupLoadingIndicator = function _setupLoadingIndicator() {
    // Setup loading indicator
    if (_options.preloaderEl) {
      _toggleLoadingIndicator(true);

      _listen('beforeChange', function () {
        clearTimeout(_loadingIndicatorTimeout); // display loading indicator with delay

        _loadingIndicatorTimeout = setTimeout(function () {
          if (pswp.currItem && pswp.currItem.loading) {
            if (!pswp.allowProgressiveImg() || pswp.currItem.img && !pswp.currItem.img.naturalWidth) {
              // show preloader if progressive loading is not enabled, 
              // or image width is not defined yet (because of slow connection)
              _toggleLoadingIndicator(false); // items-controller.js function allowProgressiveImg

            }
          } else {
            _toggleLoadingIndicator(true); // hide preloader

          }
        }, _options.loadingIndicatorDelay);
      });

      _listen('imageLoadComplete', function (index, item) {
        if (pswp.currItem === item) {
          _toggleLoadingIndicator(true);
        }
      });
    }
  },
      _toggleLoadingIndicator = function _toggleLoadingIndicator(hide) {
    if (_loadingIndicatorHidden !== hide) {
      _togglePswpClass(_loadingIndicator, 'preloader--active', !hide);

      _loadingIndicatorHidden = hide;
    }
  },
      _applyNavBarGaps = function _applyNavBarGaps(item) {
    var gap = item.vGap;

    if (_fitControlsInViewport()) {
      var bars = _options.barsSize;

      if (_options.captionEl && bars.bottom === 'auto') {
        if (!_fakeCaptionContainer) {
          _fakeCaptionContainer = framework.createEl('pswp__caption pswp__caption--fake');

          _fakeCaptionContainer.appendChild(framework.createEl('pswp__caption__center'));

          _controls.insertBefore(_fakeCaptionContainer, _captionContainer);

          framework.addClass(_controls, 'pswp__ui--fit');
        }

        if (_options.addCaptionHTMLFn(item, _fakeCaptionContainer, true)) {
          var captionSize = _fakeCaptionContainer.clientHeight;
          gap.bottom = parseInt(captionSize, 10) || 44;
        } else {
          gap.bottom = bars.top; // if no caption, set size of bottom gap to size of top
        }
      } else {
        gap.bottom = bars.bottom === 'auto' ? 0 : bars.bottom;
      } // height of top bar is static, no need to calculate it


      gap.top = bars.top;
    } else {
      gap.top = gap.bottom = 0;
    }
  },
      _setupIdle = function _setupIdle() {
    // Hide controls when mouse is used
    if (_options.timeToIdle) {
      _listen('mouseUsed', function () {
        framework.bind(document, 'mousemove', _onIdleMouseMove);
        framework.bind(document, 'mouseout', _onMouseLeaveWindow);
        _idleInterval = setInterval(function () {
          _idleIncrement++;

          if (_idleIncrement === 2) {
            ui.setIdle(true);
          }
        }, _options.timeToIdle / 2);
      });
    }
  },
      _setupHidingControlsDuringGestures = function _setupHidingControlsDuringGestures() {
    // Hide controls on vertical drag
    _listen('onVerticalDrag', function (now) {
      if (_controlsVisible && now < 0.95) {
        ui.hideControls();
      } else if (!_controlsVisible && now >= 0.95) {
        ui.showControls();
      }
    }); // Hide controls when pinching to close


    var pinchControlsHidden;

    _listen('onPinchClose', function (now) {
      if (_controlsVisible && now < 0.9) {
        ui.hideControls();
        pinchControlsHidden = true;
      } else if (pinchControlsHidden && !_controlsVisible && now > 0.9) {
        ui.showControls();
      }
    });

    _listen('zoomGestureEnded', function () {
      pinchControlsHidden = false;

      if (pinchControlsHidden && !_controlsVisible) {
        ui.showControls();
      }
    });
  };

  var _uiElements = [{
    name: 'caption',
    option: 'captionEl',
    onInit: function onInit(el) {
      _captionContainer = el;
    }
  }, {
    name: 'share-modal',
    option: 'shareEl',
    onInit: function onInit(el) {
      _shareModal = el;
    },
    onTap: function onTap() {
      _toggleShareModal();
    }
  }, {
    name: 'button--share',
    option: 'shareEl',
    onInit: function onInit(el) {
      _shareButton = el;
    },
    onTap: function onTap() {
      pswp.shout('userInteractionHappened');

      _toggleShareModal();
    }
  }, {
    name: 'button--download',
    option: 'downloadEl',
    onTap: function onTap() {
      pswp.shout('userInteractionHappened');
      var downloadButtons = pswp.currItem.thumbnailContainer.getElementsByClassName('eg-download');

      if (downloadButtons.length > 0) {
        downloadButtons[0].click();
      }
    }
  }, {
    name: 'button--add2cart',
    option: 'add2cartEl',
    onInit: function onInit(el) {
      _add2cartButton = el;
    },
    onTap: function onTap() {
      pswp.shout('userInteractionHappened');

      _toggleAdd2cartModal();
    }
  }, {
    name: 'button--zoom',
    option: 'zoomEl',
    onTap: function onTap() {
      pswp.shout('userInteractionHappened');
      pswp.toggleDesktopZoom();
    }
  }, {
    name: 'counter',
    option: 'counterEl',
    onInit: function onInit(el) {
      _indexIndicator = el;
    }
  }, {
    name: 'button--close',
    option: 'closeEl',
    onTap: pswp.close
  }, {
    name: 'button--arrow--left',
    option: 'arrowEl',
    onTap: function onTap() {
      pswp.shout('userInteractionHappened');
      pswp.prev();
    }
  }, {
    name: 'button--arrow--right',
    option: 'arrowEl',
    onTap: function onTap() {
      pswp.shout('userInteractionHappened');
      pswp.next();
    }
  }, {
    name: 'button--fs',
    option: 'fullscreenEl',
    onTap: function onTap() {
      if (_fullscrenAPI.isFullscreen()) {
        _fullscrenAPI.exit();
      } else {
        _fullscrenAPI.enter();
      }
    }
  }, {
    name: 'preloader',
    option: 'preloaderEl',
    onInit: function onInit(el) {
      _loadingIndicator = el;
    }
  }];

  var _setupUIElements = function _setupUIElements() {
    var item, classAttr, uiElement;

    var loopThroughChildElements = function loopThroughChildElements(sChildren) {
      if (!sChildren) {
        return;
      }

      var l = sChildren.length;

      for (var i = 0; i < l; i++) {
        item = sChildren[i];
        classAttr = item.className;

        for (var a = 0; a < _uiElements.length; a++) {
          uiElement = _uiElements[a];

          if (classAttr.indexOf('pswp__' + uiElement.name) > -1) {
            if (_options[uiElement.option]) {
              // if element is not disabled from options
              framework.removeClass(item, 'pswp__element--disabled');

              if (uiElement.onInit) {
                uiElement.onInit(item);
              } //item.style.display = 'block';

            } else {
              framework.addClass(item, 'pswp__element--disabled'); //item.style.display = 'none';
            }
          }
        }
      }
    };

    loopThroughChildElements(_controls.children);
    var topBar = framework.getChildByClass(_controls, 'pswp__top-bar');

    if (topBar) {
      loopThroughChildElements(topBar.children);
    }
  };

  ui.init = function () {
    // extend options
    framework.extend(pswp.options, _defaultUIOptions, true); // create local link for fast access

    _options = pswp.options; // find pswp__ui element

    _controls = framework.getChildByClass(pswp.scrollWrap, 'pswp__ui'); // create local link

    _listen = pswp.listen;

    _setupHidingControlsDuringGestures(); // update controls when slides change


    _listen('beforeChange', ui.update); // toggle zoom on double-tap


    _listen('doubleTap', function (point) {
      var initialZoomLevel = pswp.currItem.initialZoomLevel;

      if (pswp.getZoomLevel() !== initialZoomLevel) {
        pswp.zoomTo(initialZoomLevel, point, 333);
      } else {
        pswp.zoomTo(_options.getDoubleTapZoom(false, pswp.currItem), point, 333);
      }
    }); // Allow text selection in caption


    _listen('preventDragEvent', function (e, isDown, preventObj) {
      var t = e.target || e.srcElement;

      if (t && t.getAttribute('class') && e.type.indexOf('mouse') > -1 && (t.getAttribute('class').indexOf('__caption') > 0 || /(SMALL|STRONG|EM)/i.test(t.tagName))) {
        preventObj.prevent = false;
      }
    }); // bind events for UI


    _listen('bindEvents', function () {
      framework.bind(_controls, 'pswpTap click', _onControlsTap);
      framework.bind(pswp.scrollWrap, 'pswpTap', ui.onGlobalTap);

      if (!pswp.likelyTouchDevice) {
        framework.bind(pswp.scrollWrap, 'mouseover', ui.onMouseOver);
      }
    }); // unbind events for UI


    _listen('unbindEvents', function () {
      if (!_shareModalHidden) {
        _toggleShareModal();
      }

      if (!_add2cartModalHidden) {
        _toggleAdd2cartModal();
      }

      if (_idleInterval) {
        clearInterval(_idleInterval);
      }

      framework.unbind(document, 'mouseout', _onMouseLeaveWindow);
      framework.unbind(document, 'mousemove', _onIdleMouseMove);
      framework.unbind(_controls, 'pswpTap click', _onControlsTap);
      framework.unbind(pswp.scrollWrap, 'pswpTap', ui.onGlobalTap);
      framework.unbind(pswp.scrollWrap, 'mouseover', ui.onMouseOver);

      if (_fullscrenAPI) {
        framework.unbind(document, _fullscrenAPI.eventK, ui.updateFullscreen);

        if (_fullscrenAPI.isFullscreen()) {
          _options.hideAnimationDuration = 0;

          _fullscrenAPI.exit();
        }

        _fullscrenAPI = null;
      }
    }); // clean up things when gallery is destroyed


    _listen('destroy', function () {
      if (_options.captionEl) {
        if (_fakeCaptionContainer) {
          _controls.removeChild(_fakeCaptionContainer);
        }

        framework.removeClass(_captionContainer, 'pswp__caption--empty');
      }

      if (_shareModal) {
        _shareModal.children[0].onclick = null;
      }

      framework.removeClass(_controls, 'pswp__ui--over-close');
      framework.addClass(_controls, 'pswp__ui--hidden');
      ui.setIdle(false);
    });

    if (!_options.showAnimationDuration) {
      framework.removeClass(_controls, 'pswp__ui--hidden');
    }

    _listen('initialZoomIn', function () {
      if (_options.showAnimationDuration) {
        framework.removeClass(_controls, 'pswp__ui--hidden');
      }
    });

    _listen('initialZoomOut', function () {
      framework.addClass(_controls, 'pswp__ui--hidden');
    });

    _listen('parseVerticalMargin', _applyNavBarGaps);

    _setupUIElements();

    if (_options.shareEl && _shareButton && _shareModal) {
      _shareModalHidden = true;
    }

    if (_options.add2cartEl && _add2cartButton) {
      _add2cartModalHidden = true;
    }

    _countNumItems();

    _setupIdle();

    _setupFullscreenAPI();

    _setupLoadingIndicator();
  };

  ui.setIdle = function (isIdle) {
    _isIdle = isIdle;

    _togglePswpClass(_controls, 'ui--idle', isIdle);
  };

  ui.update = function () {
    // Don't update UI if it's hidden
    if (_controlsVisible && pswp.currItem) {
      ui.updateIndexIndicator();

      if (_options.captionEl) {
        _options.addCaptionHTMLFn(pswp.currItem, _captionContainer);

        _togglePswpClass(_captionContainer, 'caption--empty', !pswp.currItem.title);
      }

      _overlayUIUpdated = true;
    } else {
      _overlayUIUpdated = false;
    }

    if (!_shareModalHidden) {
      _toggleShareModal();
    }

    if (!_add2cartModalHidden) {
      _toggleAdd2cartModal();
    }

    _countNumItems();
  };

  ui.updateFullscreen = function (e) {
    if (e) {
      // some browsers change window scroll position during the fullscreen
      // so PhotoSwipe updates it just in case
      setTimeout(function () {
        pswp.setScrollOffset(0, framework.getScrollY());
      }, 50);
    } // toogle pswp--fs class on root element


    framework[(_fullscrenAPI.isFullscreen() ? 'add' : 'remove') + 'Class'](pswp.template, 'pswp--fs');
  };

  ui.updateIndexIndicator = function () {
    if (_options.counterEl) {
      _indexIndicator.innerHTML = pswp.getCurrentIndex() + 1 + _options.indexIndicatorSep + _options.getNumItemsFn();
    }
  };

  ui.onGlobalTap = function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement;

    if (_blockControlsTap) {
      return;
    }

    if (e.detail && e.detail.pointerType === 'mouse') {
      // close gallery if clicked outside of the image
      if (_hasCloseClass(target)) {
        pswp.close();
        return;
      }

      if (framework.hasClass(target, 'pswp__img')) {
        if (pswp.getZoomLevel() === 1 && pswp.getZoomLevel() <= pswp.currItem.fitRatio) {
          if (_options.clickToCloseNonZoomable) {
            pswp.close();
          }
        } else {
          pswp.toggleDesktopZoom(e.detail.releasePoint);
        }
      }
    } else {
      // tap anywhere (except buttons) to toggle visibility of controls
      if (_options.tapToToggleControls) {
        if (_controlsVisible) {
          ui.hideControls();
        } else {
          ui.showControls();
        }
      } // tap to close gallery


      if (_options.tapToClose && (framework.hasClass(target, 'pswp__img') || _hasCloseClass(target))) {
        pswp.close();
        return;
      }
    }
  };

  ui.onMouseOver = function (e) {
    e = e || window.event;
    var target = e.target || e.srcElement; // add class when mouse is over an element that should close the gallery

    _togglePswpClass(_controls, 'ui--over-close', _hasCloseClass(target));
  };

  ui.hideControls = function () {
    framework.addClass(_controls, 'pswp__ui--hidden');
    _controlsVisible = false;
  };

  ui.showControls = function () {
    _controlsVisible = true;

    if (!_overlayUIUpdated) {
      ui.update();
    }

    framework.removeClass(_controls, 'pswp__ui--hidden');
  };

  ui.supportsFullscreen = function () {
    var d = document;
    return !!(d.exitFullscreen || d.mozCancelFullScreen || d.webkitExitFullscreen || d.msExitFullscreen);
  };

  ui.getFullscreenAPI = function () {
    var dE = document.documentElement,
        api,
        tF = 'fullscreenchange';

    if (dE.requestFullscreen) {
      api = {
        enterK: 'requestFullscreen',
        exitK: 'exitFullscreen',
        elementK: 'fullscreenElement',
        eventK: tF
      };
    } else if (dE.mozRequestFullScreen) {
      api = {
        enterK: 'mozRequestFullScreen',
        exitK: 'mozCancelFullScreen',
        elementK: 'mozFullScreenElement',
        eventK: 'moz' + tF
      };
    } else if (dE.webkitRequestFullscreen) {
      api = {
        enterK: 'webkitRequestFullscreen',
        exitK: 'webkitExitFullscreen',
        elementK: 'webkitFullscreenElement',
        eventK: 'webkit' + tF
      };
    } else if (dE.msRequestFullscreen) {
      api = {
        enterK: 'msRequestFullscreen',
        exitK: 'msExitFullscreen',
        elementK: 'msFullscreenElement',
        eventK: 'MSFullscreenChange'
      };
    }

    if (api) {
      api.enter = function () {
        // disable close-on-scroll in fullscreen
        _initalCloseOnScrollValue = _options.closeOnScroll;
        _options.closeOnScroll = false;

        if (this.enterK === 'webkitRequestFullscreen') {
          pswp.template[this.enterK](Element.ALLOW_KEYBOARD_INPUT);
        } else {
          return pswp.template[this.enterK]();
        }
      };

      api.exit = function () {
        _options.closeOnScroll = _initalCloseOnScrollValue;
        return document[this.exitK]();
      };

      api.isFullscreen = function () {
        return document[this.elementK];
      };
    }

    return api;
  };
}
;

/***/ }),

/***/ "./photoswipe/photoswipe.js":
/*!**********************************!*\
  !*** ./photoswipe/photoswipe.js ***!
  \**********************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* export default binding */ __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*! PhotoSwipe - v4.1.3 - 2019-01-08
* http://photoswipe.com
* Copyright (c) 2019 Dmitry Semenov; */
/* harmony default export */ function __WEBPACK_DEFAULT_EXPORT__(template, UiClass, items, options) {
  /*>>framework-bridge*/

  /**
   *
   * Set of generic functions used by gallery.
   * 
   * You're free to modify anything here as long as functionality is kept.
   * 
   */
  var framework = {
    features: null,
    bind: function bind(target, type, listener, unbind) {
      var methodName = (unbind ? 'remove' : 'add') + 'EventListener';
      type = type.split(' ');

      for (var i = 0; i < type.length; i++) {
        if (type[i]) {
          target[methodName](type[i], listener, false);
        }
      }
    },
    isArray: function isArray(obj) {
      return obj instanceof Array;
    },
    createEl: function createEl(classes, tag) {
      var el = document.createElement(tag || 'div');

      if (classes) {
        el.className = classes;
      }

      return el;
    },
    getScrollY: function getScrollY() {
      var yOffset = window.pageYOffset;
      return yOffset !== undefined ? yOffset : document.documentElement.scrollTop;
    },
    unbind: function unbind(target, type, listener) {
      framework.bind(target, type, listener, true);
    },
    removeClass: function removeClass(el, className) {
      var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
      el.className = el.className.replace(reg, ' ').replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    },
    addClass: function addClass(el, className) {
      if (!framework.hasClass(el, className)) {
        el.className += (el.className ? ' ' : '') + className;
      }
    },
    hasClass: function hasClass(el, className) {
      return el.className && new RegExp('(^|\\s)' + className + '(\\s|$)').test(el.className);
    },
    getChildByClass: function getChildByClass(parentEl, childClassName) {
      var node = parentEl.firstChild;

      while (node) {
        if (framework.hasClass(node, childClassName)) {
          return node;
        }

        node = node.nextSibling;
      }
    },
    arraySearch: function arraySearch(array, value, key) {
      var i = array.length;

      while (i--) {
        if (array[i][key] === value) {
          return i;
        }
      }

      return -1;
    },
    extend: function extend(o1, o2, preventOverwrite) {
      for (var prop in o2) {
        if (o2.hasOwnProperty(prop)) {
          if (preventOverwrite && o1.hasOwnProperty(prop)) {
            continue;
          }

          o1[prop] = o2[prop];
        }
      }
    },
    easing: {
      sine: {
        out: function out(k) {
          return Math.sin(k * (Math.PI / 2));
        },
        inOut: function inOut(k) {
          return -(Math.cos(Math.PI * k) - 1) / 2;
        }
      },
      cubic: {
        out: function out(k) {
          return --k * k * k + 1;
        }
      }
      /*
      	elastic: {
      		out: function ( k ) {
      				var s, a = 0.1, p = 0.4;
      			if ( k === 0 ) return 0;
      			if ( k === 1 ) return 1;
      			if ( !a || a < 1 ) { a = 1; s = p / 4; }
      			else s = p * Math.asin( 1 / a ) / ( 2 * Math.PI );
      			return ( a * Math.pow( 2, - 10 * k) * Math.sin( ( k - s ) * ( 2 * Math.PI ) / p ) + 1 );
      			},
      	},
      	back: {
      		out: function ( k ) {
      			var s = 1.70158;
      			return --k * k * ( ( s + 1 ) * k + s ) + 1;
      		}
      	}
      */

    },

    /**
     * 
     * @return {object}
     * 
     * {
     *  raf : request animation frame function
     *  caf : cancel animation frame function
     *  transfrom : transform property key (with vendor), or null if not supported
     *  oldIE : IE8 or below
     * }
     * 
     */
    detectFeatures: function detectFeatures() {
      if (framework.features) {
        return framework.features;
      }

      var helperEl = framework.createEl(),
          helperStyle = helperEl.style,
          vendor = '',
          features = {}; // IE8 and below

      features.oldIE = document.all && !document.addEventListener;
      features.touch = 'ontouchstart' in window;

      if (window.requestAnimationFrame) {
        features.raf = window.requestAnimationFrame;
        features.caf = window.cancelAnimationFrame;
      }

      features.pointerEvent = !!window.PointerEvent || navigator.msPointerEnabled; // fix false-positive detection of old Android in new IE
      // (IE11 ua string contains "Android 4.0")

      if (!features.pointerEvent) {
        var ua = navigator.userAgent; // Detect if device is iPhone or iPod and if it's older than iOS 8
        // http://stackoverflow.com/a/14223920
        // 
        // This detection is made because of buggy top/bottom toolbars
        // that don't trigger window.resize event.
        // For more info refer to _isFixedPosition variable in core.js

        if (/iP(hone|od)/.test(navigator.platform)) {
          var v = navigator.appVersion.match(/OS (\d+)_(\d+)_?(\d+)?/);

          if (v && v.length > 0) {
            v = parseInt(v[1], 10);

            if (v >= 1 && v < 8) {
              features.isOldIOSPhone = true;
            }
          }
        } // Detect old Android (before KitKat)
        // due to bugs related to position:fixed
        // http://stackoverflow.com/questions/7184573/pick-up-the-android-version-in-the-browser-by-javascript


        var match = ua.match(/Android\s([0-9\.]*)/);
        var androidversion = match ? match[1] : 0;
        androidversion = parseFloat(androidversion);

        if (androidversion >= 1) {
          if (androidversion < 4.4) {
            features.isOldAndroid = true; // for fixed position bug & performance
          }

          features.androidVersion = androidversion; // for touchend bug
        }

        features.isMobileOpera = /opera mini|opera mobi/i.test(ua); // p.s. yes, yes, UA sniffing is bad, propose your solution for above bugs.
      }

      var styleChecks = ['transform', 'perspective', 'animationName'],
          vendors = ['', 'webkit', 'Moz', 'ms', 'O'],
          styleCheckItem,
          styleName;

      for (var i = 0; i < 4; i++) {
        vendor = vendors[i];

        for (var a = 0; a < 3; a++) {
          styleCheckItem = styleChecks[a]; // uppercase first letter of property name, if vendor is present

          styleName = vendor + (vendor ? styleCheckItem.charAt(0).toUpperCase() + styleCheckItem.slice(1) : styleCheckItem);

          if (!features[styleCheckItem] && styleName in helperStyle) {
            features[styleCheckItem] = styleName;
          }
        }

        if (vendor && !features.raf) {
          vendor = vendor.toLowerCase();
          features.raf = window[vendor + 'RequestAnimationFrame'];

          if (features.raf) {
            features.caf = window[vendor + 'CancelAnimationFrame'] || window[vendor + 'CancelRequestAnimationFrame'];
          }
        }
      }

      if (!features.raf) {
        var lastTime = 0;

        features.raf = function (fn) {
          var currTime = new Date().getTime();
          var timeToCall = Math.max(0, 16 - (currTime - lastTime));
          var id = window.setTimeout(function () {
            fn(currTime + timeToCall);
          }, timeToCall);
          lastTime = currTime + timeToCall;
          return id;
        };

        features.caf = function (id) {
          clearTimeout(id);
        };
      } // Detect SVG support


      features.svg = !!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect;
      framework.features = features;
      return features;
    }
  };
  framework.detectFeatures(); // Override addEventListener for old versions of IE

  if (framework.features.oldIE) {
    framework.bind = function (target, type, listener, unbind) {
      type = type.split(' ');

      var methodName = (unbind ? 'detach' : 'attach') + 'Event',
          evName,
          _handleEv = function _handleEv() {
        listener.handleEvent.call(listener);
      };

      for (var i = 0; i < type.length; i++) {
        evName = type[i];

        if (evName) {
          if (_typeof(listener) === 'object' && listener.handleEvent) {
            if (!unbind) {
              listener['oldIE' + evName] = _handleEv;
            } else {
              if (!listener['oldIE' + evName]) {
                return false;
              }
            }

            target[methodName]('on' + evName, listener['oldIE' + evName]);
          } else {
            target[methodName]('on' + evName, listener);
          }
        }
      }
    };
  }
  /*>>framework-bridge*/

  /*>>core*/
  //function(template, UiClass, items, options)


  var self = this;
  /**
   * Static vars, don't change unless you know what you're doing.
   */

  var DOUBLE_TAP_RADIUS = 25,
      NUM_HOLDERS = 3;
  /**
   * Options
   */

  var _options = {
    allowPanToNext: true,
    spacing: 0.12,
    bgOpacity: 1,
    mouseUsed: false,
    loop: true,
    pinchToClose: true,
    closeOnScroll: true,
    closeOnVerticalDrag: true,
    verticalDragRange: 0.75,
    hideAnimationDuration: 333,
    showAnimationDuration: 333,
    showHideOpacity: false,
    focus: true,
    escKey: true,
    arrowKeys: true,
    mainScrollEndFriction: 0.35,
    panEndFriction: 0.35,
    isClickableElement: function isClickableElement(el) {
      return el.tagName === 'A';
    },
    getDoubleTapZoom: function getDoubleTapZoom(isMouseClick, item) {
      if (isMouseClick) {
        return 1;
      } else {
        return item.initialZoomLevel < 0.7 ? 1 : 1.33;
      }
    },
    maxSpreadZoom: 1.33,
    modal: true,
    // not fully implemented yet
    scaleMode: 'fit' // TODO

  };
  framework.extend(_options, options);
  /**
   * Private helper variables & functions
   */

  var _getEmptyPoint = function _getEmptyPoint() {
    return {
      x: 0,
      y: 0
    };
  };

  var _isOpen,
      _isDestroying,
      _closedByScroll,
      _currentItemIndex,
      _containerStyle,
      _containerShiftIndex,
      _currPanDist = _getEmptyPoint(),
      _startPanOffset = _getEmptyPoint(),
      _panOffset = _getEmptyPoint(),
      _upMoveEvents,
      // drag move, drag end & drag cancel events array
  _downEvents,
      // drag start events array
  _globalEventHandlers,
      _viewportSize = {},
      _currZoomLevel,
      _startZoomLevel,
      _translatePrefix,
      _translateSufix,
      _updateSizeInterval,
      _itemsNeedUpdate,
      _currPositionIndex = 0,
      _offset = {},
      _slideSize = _getEmptyPoint(),
      // size of slide area, including spacing
  _itemHolders,
      _prevItemIndex,
      _indexDiff = 0,
      // difference of indexes since last content update
  _dragStartEvent,
      _dragMoveEvent,
      _dragEndEvent,
      _dragCancelEvent,
      _transformKey,
      _pointerEventEnabled,
      _isFixedPosition = true,
      _likelyTouchDevice,
      _modules = [],
      _requestAF,
      _cancelAF,
      _initalClassName,
      _initalWindowScrollY,
      _oldIE,
      _currentWindowScrollY,
      _features,
      _windowVisibleSize = {},
      _renderMaxResolution = false,
      _orientationChangeTimeout,
      // Registers PhotoSWipe module (History, Controller ...)
  _registerModule = function _registerModule(name, module) {
    framework.extend(self, module.publicMethods);

    _modules.push(name);
  },
      _getLoopedId = function _getLoopedId(index) {
    var numSlides = _getNumItems();

    if (index > numSlides - 1) {
      return index - numSlides;
    } else if (index < 0) {
      return numSlides + index;
    }

    return index;
  },
      // Micro bind/trigger
  _listeners = {},
      _listen = function _listen(name, fn) {
    if (!_listeners[name]) {
      _listeners[name] = [];
    }

    return _listeners[name].push(fn);
  },
      _shout = function _shout(name) {
    var listeners = _listeners[name];

    if (listeners) {
      var args = Array.prototype.slice.call(arguments);
      args.shift();

      for (var i = 0; i < listeners.length; i++) {
        listeners[i].apply(self, args);
      }
    }
  },
      _getCurrentTime = function _getCurrentTime() {
    return new Date().getTime();
  },
      _applyBgOpacity = function _applyBgOpacity(opacity) {
    _bgOpacity = opacity;
    self.bg.style.opacity = opacity * _options.bgOpacity;
  },
      _applyZoomTransform = function _applyZoomTransform(styleObj, x, y, zoom, item) {
    if (!_renderMaxResolution || item && item !== self.currItem) {
      zoom = zoom / (item ? item.fitRatio : self.currItem.fitRatio);
    }

    styleObj[_transformKey] = _translatePrefix + x + 'px, ' + y + 'px' + _translateSufix + ' scale(' + zoom + ')';
  },
      _applyCurrentZoomPan = function _applyCurrentZoomPan(allowRenderResolution) {
    if (_currZoomElementStyle) {
      if (allowRenderResolution) {
        if (_currZoomLevel > self.currItem.fitRatio) {
          if (!_renderMaxResolution) {
            _setImageSize(self.currItem, false, true);

            _renderMaxResolution = true;
          }
        } else {
          if (_renderMaxResolution) {
            _setImageSize(self.currItem);

            _renderMaxResolution = false;
          }
        }
      }

      _applyZoomTransform(_currZoomElementStyle, _panOffset.x, _panOffset.y, _currZoomLevel);
    }
  },
      _applyZoomPanToItem = function _applyZoomPanToItem(item) {
    if (item.container) {
      _applyZoomTransform(item.container.style, item.initialPosition.x, item.initialPosition.y, item.initialZoomLevel, item);
    }
  },
      _setTranslateX = function _setTranslateX(x, elStyle) {
    elStyle[_transformKey] = _translatePrefix + x + 'px, 0px' + _translateSufix;
  },
      _moveMainScroll = function _moveMainScroll(x, dragging) {
    if (!_options.loop && dragging) {
      var newSlideIndexOffset = _currentItemIndex + (_slideSize.x * _currPositionIndex - x) / _slideSize.x,
          delta = Math.round(x - _mainScrollPos.x);

      if (newSlideIndexOffset < 0 && delta > 0 || newSlideIndexOffset >= _getNumItems() - 1 && delta < 0) {
        x = _mainScrollPos.x + delta * _options.mainScrollEndFriction;
      }
    }

    _mainScrollPos.x = x;

    _setTranslateX(x, _containerStyle);
  },
      _calculatePanOffset = function _calculatePanOffset(axis, zoomLevel) {
    var m = _midZoomPoint[axis] - _offset[axis];
    return _startPanOffset[axis] + _currPanDist[axis] + m - m * (zoomLevel / _startZoomLevel);
  },
      _equalizePoints = function _equalizePoints(p1, p2) {
    p1.x = p2.x;
    p1.y = p2.y;

    if (p2.id) {
      p1.id = p2.id;
    }
  },
      _roundPoint = function _roundPoint(p) {
    p.x = Math.round(p.x);
    p.y = Math.round(p.y);
  },
      _mouseMoveTimeout = null,
      _onFirstMouseMove = function _onFirstMouseMove() {
    // Wait until mouse move event is fired at least twice during 100ms
    // We do this, because some mobile browsers trigger it on touchstart
    if (_mouseMoveTimeout) {
      framework.unbind(document, 'mousemove', _onFirstMouseMove);
      framework.addClass(template, 'pswp--has_mouse');
      _options.mouseUsed = true;

      _shout('mouseUsed');
    }

    _mouseMoveTimeout = setTimeout(function () {
      _mouseMoveTimeout = null;
    }, 100);
  },
      _bindEvents = function _bindEvents() {
    framework.bind(document, 'keydown', self);

    if (_features.transform) {
      // don't bind click event in browsers that don't support transform (mostly IE8)
      framework.bind(self.scrollWrap, 'click', self);
    }

    if (!_options.mouseUsed) {
      framework.bind(document, 'mousemove', _onFirstMouseMove);
    }

    framework.bind(window, 'resize scroll orientationchange', self);

    _shout('bindEvents');
  },
      _unbindEvents = function _unbindEvents() {
    framework.unbind(window, 'resize scroll orientationchange', self);
    framework.unbind(window, 'scroll', _globalEventHandlers.scroll);
    framework.unbind(document, 'keydown', self);
    framework.unbind(document, 'mousemove', _onFirstMouseMove);

    if (_features.transform) {
      framework.unbind(self.scrollWrap, 'click', self);
    }

    if (_isDragging) {
      framework.unbind(window, _upMoveEvents, self);
    }

    clearTimeout(_orientationChangeTimeout);

    _shout('unbindEvents');
  },
      _calculatePanBounds = function _calculatePanBounds(zoomLevel, update) {
    var bounds = _calculateItemSize(self.currItem, _viewportSize, zoomLevel);

    if (update) {
      _currPanBounds = bounds;
    }

    return bounds;
  },
      _getMinZoomLevel = function _getMinZoomLevel(item) {
    if (!item) {
      item = self.currItem;
    }

    return item.initialZoomLevel;
  },
      _getMaxZoomLevel = function _getMaxZoomLevel(item) {
    if (!item) {
      item = self.currItem;
    }

    return item.w > 0 ? _options.maxSpreadZoom : 1;
  },
      // Return true if offset is out of the bounds
  _modifyDestPanOffset = function _modifyDestPanOffset(axis, destPanBounds, destPanOffset, destZoomLevel) {
    if (destZoomLevel === self.currItem.initialZoomLevel) {
      destPanOffset[axis] = self.currItem.initialPosition[axis];
      return true;
    } else {
      destPanOffset[axis] = _calculatePanOffset(axis, destZoomLevel);

      if (destPanOffset[axis] > destPanBounds.min[axis]) {
        destPanOffset[axis] = destPanBounds.min[axis];
        return true;
      } else if (destPanOffset[axis] < destPanBounds.max[axis]) {
        destPanOffset[axis] = destPanBounds.max[axis];
        return true;
      }
    }

    return false;
  },
      _setupTransforms = function _setupTransforms() {
    if (_transformKey) {
      // setup 3d transforms
      var allow3dTransform = _features.perspective && !_likelyTouchDevice;
      _translatePrefix = 'translate' + (allow3dTransform ? '3d(' : '(');
      _translateSufix = _features.perspective ? ', 0px)' : ')';
      return;
    } // Override zoom/pan/move functions in case old browser is used (most likely IE)
    // (so they use left/top/width/height, instead of CSS transform)


    _transformKey = 'left';
    framework.addClass(template, 'pswp--ie');

    _setTranslateX = function _setTranslateX(x, elStyle) {
      elStyle.left = x + 'px';
    };

    _applyZoomPanToItem = function _applyZoomPanToItem(item) {
      var zoomRatio = item.fitRatio > 1 ? 1 : item.fitRatio,
          s = item.container.style,
          w = zoomRatio * item.w,
          h = zoomRatio * item.h;
      s.width = w + 'px';
      s.height = h + 'px';
      s.left = item.initialPosition.x + 'px';
      s.top = item.initialPosition.y + 'px';
    };

    _applyCurrentZoomPan = function _applyCurrentZoomPan() {
      if (_currZoomElementStyle) {
        var s = _currZoomElementStyle,
            item = self.currItem,
            zoomRatio = item.fitRatio > 1 ? 1 : item.fitRatio,
            w = zoomRatio * item.w,
            h = zoomRatio * item.h;
        s.width = w + 'px';
        s.height = h + 'px';
        s.left = _panOffset.x + 'px';
        s.top = _panOffset.y + 'px';
      }
    };
  },
      _onKeyDown = function _onKeyDown(e) {
    var keydownAction = '';

    if (_options.escKey && e.keyCode === 27) {
      keydownAction = 'close';
    } else if (_options.arrowKeys) {
      if (e.keyCode === 37) {
        keydownAction = 'prev';
      } else if (e.keyCode === 39) {
        keydownAction = 'next';
      }
    }

    if (keydownAction) {
      // don't do anything if special key pressed to prevent from overriding default browser actions
      // e.g. in Chrome on Mac cmd+arrow-left returns to previous page
      if (!e.ctrlKey && !e.altKey && !e.shiftKey && !e.metaKey) {
        if (e.preventDefault) {
          e.preventDefault();
        } else {
          e.returnValue = false;
        }

        self[keydownAction]();
      }
    }
  },
      _onGlobalClick = function _onGlobalClick(e) {
    if (!e) {
      return;
    } // don't allow click event to pass through when triggering after drag or some other gesture


    if (_moved || _zoomStarted || _mainScrollAnimating || _verticalDragInitiated) {
      e.preventDefault();
      e.stopPropagation();
    }
  },
      _updatePageScrollOffset = function _updatePageScrollOffset() {
    self.setScrollOffset(0, framework.getScrollY());
  }; // Micro animation engine


  var _animations = {},
      _numAnimations = 0,
      _stopAnimation = function _stopAnimation(name) {
    if (_animations[name]) {
      if (_animations[name].raf) {
        _cancelAF(_animations[name].raf);
      }

      _numAnimations--;
      delete _animations[name];
    }
  },
      _registerStartAnimation = function _registerStartAnimation(name) {
    if (_animations[name]) {
      _stopAnimation(name);
    }

    if (!_animations[name]) {
      _numAnimations++;
      _animations[name] = {};
    }
  },
      _stopAllAnimations = function _stopAllAnimations() {
    for (var prop in _animations) {
      if (_animations.hasOwnProperty(prop)) {
        _stopAnimation(prop);
      }
    }
  },
      _animateProp = function _animateProp(name, b, endProp, d, easingFn, onUpdate, onComplete) {
    var startAnimTime = _getCurrentTime(),
        t;

    _registerStartAnimation(name);

    var animloop = function animloop() {
      if (_animations[name]) {
        t = _getCurrentTime() - startAnimTime; // time diff
        //b - beginning (start prop)
        //d - anim duration

        if (t >= d) {
          _stopAnimation(name);

          onUpdate(endProp);

          if (onComplete) {
            onComplete();
          }

          return;
        }

        onUpdate((endProp - b) * easingFn(t / d) + b);
        _animations[name].raf = _requestAF(animloop);
      }
    };

    animloop();
  };

  var publicMethods = {
    // make a few local variables and functions public
    shout: _shout,
    listen: _listen,
    viewportSize: _viewportSize,
    options: _options,
    isMainScrollAnimating: function isMainScrollAnimating() {
      return _mainScrollAnimating;
    },
    getZoomLevel: function getZoomLevel() {
      return _currZoomLevel;
    },
    getCurrentIndex: function getCurrentIndex() {
      return _currentItemIndex;
    },
    isDragging: function isDragging() {
      return _isDragging;
    },
    isZooming: function isZooming() {
      return _isZooming;
    },
    setScrollOffset: function setScrollOffset(x, y) {
      _offset.x = x;
      _currentWindowScrollY = _offset.y = y;

      _shout('updateScrollOffset', _offset);
    },
    applyZoomPan: function applyZoomPan(zoomLevel, panX, panY, allowRenderResolution) {
      _panOffset.x = panX;
      _panOffset.y = panY;
      _currZoomLevel = zoomLevel;

      _applyCurrentZoomPan(allowRenderResolution);
    },
    init: function init() {
      if (_isOpen || _isDestroying) {
        return;
      }

      var i;
      self.framework = framework; // basic functionality

      self.template = template; // root DOM element of PhotoSwipe

      self.bg = framework.getChildByClass(template, 'pswp__bg');
      _initalClassName = template.className;
      _isOpen = true;
      _features = framework.detectFeatures();
      _requestAF = _features.raf;
      _cancelAF = _features.caf;
      _transformKey = _features.transform;
      _oldIE = _features.oldIE;
      self.scrollWrap = framework.getChildByClass(template, 'pswp__scroll-wrap');
      self.container = framework.getChildByClass(self.scrollWrap, 'pswp__container');
      _containerStyle = self.container.style; // for fast access
      // Objects that hold slides (there are only 3 in DOM)

      self.itemHolders = _itemHolders = [{
        el: self.container.children[0],
        wrap: 0,
        index: -1
      }, {
        el: self.container.children[1],
        wrap: 0,
        index: -1
      }, {
        el: self.container.children[2],
        wrap: 0,
        index: -1
      }]; // hide nearby item holders until initial zoom animation finishes (to avoid extra Paints)

      _itemHolders[0].el.style.display = _itemHolders[2].el.style.display = 'none';

      _setupTransforms(); // Setup global events


      _globalEventHandlers = {
        resize: self.updateSize,
        // Fixes: iOS 10.3 resize event
        // does not update scrollWrap.clientWidth instantly after resize
        // https://github.com/dimsemenov/PhotoSwipe/issues/1315
        orientationchange: function orientationchange() {
          clearTimeout(_orientationChangeTimeout);
          _orientationChangeTimeout = setTimeout(function () {
            if (_viewportSize.x !== self.scrollWrap.clientWidth) {
              self.updateSize();
            }
          }, 500);
        },
        scroll: _updatePageScrollOffset,
        keydown: _onKeyDown,
        click: _onGlobalClick
      }; // disable show/hide effects on old browsers that don't support CSS animations or transforms, 
      // old IOS, Android and Opera mobile. Blackberry seems to work fine, even older models.

      var oldPhone = _features.isOldIOSPhone || _features.isOldAndroid || _features.isMobileOpera;

      if (!_features.animationName || !_features.transform || oldPhone) {
        _options.showAnimationDuration = _options.hideAnimationDuration = 0;
      } // init modules


      for (i = 0; i < _modules.length; i++) {
        self['init' + _modules[i]]();
      } // init


      if (UiClass) {
        var ui = self.ui = new UiClass(self, framework);
        ui.init();
      }

      _shout('firstUpdate');

      _currentItemIndex = _currentItemIndex || _options.index || 0; // validate index

      if (isNaN(_currentItemIndex) || _currentItemIndex < 0 || _currentItemIndex >= _getNumItems()) {
        _currentItemIndex = 0;
      }

      self.currItem = _getItemAt(_currentItemIndex);

      if (_features.isOldIOSPhone || _features.isOldAndroid) {
        _isFixedPosition = false;
      }

      template.setAttribute('aria-hidden', 'false');

      if (_options.modal) {
        if (!_isFixedPosition) {
          template.style.position = 'absolute';
          template.style.top = framework.getScrollY() + 'px';
        } else {
          template.style.position = 'fixed';
        }
      }

      if (_currentWindowScrollY === undefined) {
        _shout('initialLayout');

        _currentWindowScrollY = _initalWindowScrollY = framework.getScrollY();
      } // add classes to root element of PhotoSwipe


      var rootClasses = 'pswp--open ';

      if (_options.mainClass) {
        rootClasses += _options.mainClass + ' ';
      }

      if (_options.showHideOpacity) {
        rootClasses += 'pswp--animate_opacity ';
      }

      rootClasses += _likelyTouchDevice ? 'pswp--touch' : 'pswp--notouch';
      rootClasses += _features.animationName ? ' pswp--css_animation' : '';
      rootClasses += _features.svg ? ' pswp--svg' : '';
      framework.addClass(template, rootClasses);
      self.updateSize(); // initial update

      _containerShiftIndex = -1;
      _indexDiff = null;

      for (i = 0; i < NUM_HOLDERS; i++) {
        _setTranslateX((i + _containerShiftIndex) * _slideSize.x, _itemHolders[i].el.style);
      }

      if (!_oldIE) {
        framework.bind(self.scrollWrap, _downEvents, self); // no dragging for old IE
      }

      _listen('initialZoomInEnd', function () {
        self.setContent(_itemHolders[0], _currentItemIndex - 1);
        self.setContent(_itemHolders[2], _currentItemIndex + 1);
        _itemHolders[0].el.style.display = _itemHolders[2].el.style.display = 'block';

        if (_options.focus) {
          // focus causes layout, 
          // which causes lag during the animation, 
          // that's why we delay it untill the initial zoom transition ends
          template.focus();
        }

        _bindEvents();
      }); // set content for center slide (first time)


      self.setContent(_itemHolders[1], _currentItemIndex);
      self.updateCurrItem();

      _shout('afterInit');

      if (!_isFixedPosition) {
        // On all versions of iOS lower than 8.0, we check size of viewport every second.
        // 
        // This is done to detect when Safari top & bottom bars appear, 
        // as this action doesn't trigger any events (like resize). 
        // 
        // On iOS8 they fixed this.
        // 
        // 10 Nov 2014: iOS 7 usage ~40%. iOS 8 usage 56%.
        _updateSizeInterval = setInterval(function () {
          if (!_numAnimations && !_isDragging && !_isZooming && _currZoomLevel === self.currItem.initialZoomLevel) {
            self.updateSize();
          }
        }, 1000);
      }

      framework.addClass(template, 'pswp--visible');
    },
    // Close the gallery, then destroy it
    close: function close() {
      if (!_isOpen) {
        return;
      }

      _isOpen = false;
      _isDestroying = true;

      _shout('close');

      _unbindEvents();

      _showOrHide(self.currItem, null, true, self.destroy);
    },
    // destroys the gallery (unbinds events, cleans up intervals and timeouts to avoid memory leaks)
    destroy: function destroy() {
      _shout('destroy');

      if (_showOrHideTimeout) {
        clearTimeout(_showOrHideTimeout);
      }

      template.setAttribute('aria-hidden', 'true');
      template.className = _initalClassName;

      if (_updateSizeInterval) {
        clearInterval(_updateSizeInterval);
      }

      framework.unbind(self.scrollWrap, _downEvents, self); // we unbind scroll event at the end, as closing animation may depend on it

      framework.unbind(window, 'scroll', self);

      _stopDragUpdateLoop();

      _stopAllAnimations();

      _listeners = null;
    },

    /**
     * Pan image to position
     * @param {Number} x     
     * @param {Number} y     
     * @param {Boolean} force Will ignore bounds if set to true.
     */
    panTo: function panTo(x, y, force) {
      if (!force) {
        if (x > _currPanBounds.min.x) {
          x = _currPanBounds.min.x;
        } else if (x < _currPanBounds.max.x) {
          x = _currPanBounds.max.x;
        }

        if (y > _currPanBounds.min.y) {
          y = _currPanBounds.min.y;
        } else if (y < _currPanBounds.max.y) {
          y = _currPanBounds.max.y;
        }
      }

      _panOffset.x = x;
      _panOffset.y = y;

      _applyCurrentZoomPan();
    },
    handleEvent: function handleEvent(e) {
      e = e || window.event;

      if (_globalEventHandlers[e.type]) {
        _globalEventHandlers[e.type](e);
      }
    },
    goTo: function goTo(index) {
      index = _getLoopedId(index);
      var diff = index - _currentItemIndex;
      _indexDiff = diff;
      _currentItemIndex = index;
      self.currItem = _getItemAt(_currentItemIndex);
      _currPositionIndex -= diff;

      _moveMainScroll(_slideSize.x * _currPositionIndex);

      _stopAllAnimations();

      _mainScrollAnimating = false;
      self.updateCurrItem();
    },
    next: function next() {
      self.goTo(_currentItemIndex + 1);
    },
    prev: function prev() {
      self.goTo(_currentItemIndex - 1);
    },
    // update current zoom/pan objects
    updateCurrZoomItem: function updateCurrZoomItem(emulateSetContent) {
      if (emulateSetContent) {
        _shout('beforeChange', 0);
      } // itemHolder[1] is middle (current) item


      if (_itemHolders[1].el.children.length) {
        var zoomElement = _itemHolders[1].el.children[0];

        if (framework.hasClass(zoomElement, 'pswp__zoom-wrap')) {
          _currZoomElementStyle = zoomElement.style;
        } else {
          _currZoomElementStyle = null;
        }
      } else {
        _currZoomElementStyle = null;
      }

      _currPanBounds = self.currItem.bounds;
      _startZoomLevel = _currZoomLevel = self.currItem.initialZoomLevel;
      _panOffset.x = _currPanBounds.center.x;
      _panOffset.y = _currPanBounds.center.y;

      if (emulateSetContent) {
        _shout('afterChange');
      }
    },
    invalidateCurrItems: function invalidateCurrItems() {
      _itemsNeedUpdate = true;

      for (var i = 0; i < NUM_HOLDERS; i++) {
        if (_itemHolders[i].item) {
          _itemHolders[i].item.needsUpdate = true;
        }
      }
    },
    updateCurrItem: function updateCurrItem(beforeAnimation) {
      if (_indexDiff === 0) {
        return;
      }

      var diffAbs = Math.abs(_indexDiff),
          tempHolder;

      if (beforeAnimation && diffAbs < 2) {
        return;
      }

      self.currItem = _getItemAt(_currentItemIndex);
      _renderMaxResolution = false;

      _shout('beforeChange', _indexDiff);

      if (diffAbs >= NUM_HOLDERS) {
        _containerShiftIndex += _indexDiff + (_indexDiff > 0 ? -NUM_HOLDERS : NUM_HOLDERS);
        diffAbs = NUM_HOLDERS;
      }

      for (var i = 0; i < diffAbs; i++) {
        if (_indexDiff > 0) {
          tempHolder = _itemHolders.shift();
          _itemHolders[NUM_HOLDERS - 1] = tempHolder; // move first to last

          _containerShiftIndex++;

          _setTranslateX((_containerShiftIndex + 2) * _slideSize.x, tempHolder.el.style);

          self.setContent(tempHolder, _currentItemIndex - diffAbs + i + 1 + 1);
        } else {
          tempHolder = _itemHolders.pop();

          _itemHolders.unshift(tempHolder); // move last to first


          _containerShiftIndex--;

          _setTranslateX(_containerShiftIndex * _slideSize.x, tempHolder.el.style);

          self.setContent(tempHolder, _currentItemIndex + diffAbs - i - 1 - 1);
        }
      } // reset zoom/pan on previous item


      if (_currZoomElementStyle && Math.abs(_indexDiff) === 1) {
        var prevItem = _getItemAt(_prevItemIndex);

        if (prevItem.initialZoomLevel !== _currZoomLevel) {
          _calculateItemSize(prevItem, _viewportSize);

          _setImageSize(prevItem);

          _applyZoomPanToItem(prevItem);
        }
      } // reset diff after update


      _indexDiff = 0;
      self.updateCurrZoomItem();
      _prevItemIndex = _currentItemIndex;

      _shout('afterChange');
    },
    updateSize: function updateSize(force) {
      if (!_isFixedPosition && _options.modal) {
        var windowScrollY = framework.getScrollY();

        if (_currentWindowScrollY !== windowScrollY) {
          template.style.top = windowScrollY + 'px';
          _currentWindowScrollY = windowScrollY;
        }

        if (!force && _windowVisibleSize.x === window.innerWidth && _windowVisibleSize.y === window.innerHeight) {
          return;
        }

        _windowVisibleSize.x = window.innerWidth;
        _windowVisibleSize.y = window.innerHeight; //template.style.width = _windowVisibleSize.x + 'px';

        template.style.height = _windowVisibleSize.y + 'px';
      }

      _viewportSize.x = self.scrollWrap.clientWidth;
      _viewportSize.y = self.scrollWrap.clientHeight;

      _updatePageScrollOffset();

      _slideSize.x = _viewportSize.x + Math.round(_viewportSize.x * _options.spacing);
      _slideSize.y = _viewportSize.y;

      _moveMainScroll(_slideSize.x * _currPositionIndex);

      _shout('beforeResize'); // even may be used for example to switch image sources
      // don't re-calculate size on inital size update


      if (_containerShiftIndex !== undefined) {
        var holder, item, hIndex;

        for (var i = 0; i < NUM_HOLDERS; i++) {
          holder = _itemHolders[i];

          _setTranslateX((i + _containerShiftIndex) * _slideSize.x, holder.el.style);

          hIndex = _currentItemIndex + i - 1;

          if (_options.loop && _getNumItems() > 2) {
            hIndex = _getLoopedId(hIndex);
          } // update zoom level on items and refresh source (if needsUpdate)


          item = _getItemAt(hIndex); // re-render gallery item if `needsUpdate`,
          // or doesn't have `bounds` (entirely new slide object)

          if (item && (_itemsNeedUpdate || item.needsUpdate || !item.bounds)) {
            self.cleanSlide(item);
            self.setContent(holder, hIndex); // if "center" slide

            if (i === 1) {
              self.currItem = item;
              self.updateCurrZoomItem(true);
            }

            item.needsUpdate = false;
          } else if (holder.index === -1 && hIndex >= 0) {
            // add content first time
            self.setContent(holder, hIndex);
          }

          if (item && item.container) {
            _calculateItemSize(item, _viewportSize);

            _setImageSize(item);

            _applyZoomPanToItem(item);
          }
        }

        _itemsNeedUpdate = false;
      }

      _startZoomLevel = _currZoomLevel = self.currItem.initialZoomLevel;
      _currPanBounds = self.currItem.bounds;

      if (_currPanBounds) {
        _panOffset.x = _currPanBounds.center.x;
        _panOffset.y = _currPanBounds.center.y;

        _applyCurrentZoomPan(true);
      }

      _shout('resize');
    },
    // Zoom current item to
    zoomTo: function zoomTo(destZoomLevel, centerPoint, speed, easingFn, updateFn) {
      /*
      	if(destZoomLevel === 'fit') {
      		destZoomLevel = self.currItem.fitRatio;
      	} else if(destZoomLevel === 'fill') {
      		destZoomLevel = self.currItem.fillRatio;
      	}
      */
      if (centerPoint) {
        _startZoomLevel = _currZoomLevel;
        _midZoomPoint.x = Math.abs(centerPoint.x) - _panOffset.x;
        _midZoomPoint.y = Math.abs(centerPoint.y) - _panOffset.y;

        _equalizePoints(_startPanOffset, _panOffset);
      }

      var destPanBounds = _calculatePanBounds(destZoomLevel, false),
          destPanOffset = {};

      _modifyDestPanOffset('x', destPanBounds, destPanOffset, destZoomLevel);

      _modifyDestPanOffset('y', destPanBounds, destPanOffset, destZoomLevel);

      var initialZoomLevel = _currZoomLevel;
      var initialPanOffset = {
        x: _panOffset.x,
        y: _panOffset.y
      };

      _roundPoint(destPanOffset);

      var onUpdate = function onUpdate(now) {
        if (now === 1) {
          _currZoomLevel = destZoomLevel;
          _panOffset.x = destPanOffset.x;
          _panOffset.y = destPanOffset.y;
        } else {
          _currZoomLevel = (destZoomLevel - initialZoomLevel) * now + initialZoomLevel;
          _panOffset.x = (destPanOffset.x - initialPanOffset.x) * now + initialPanOffset.x;
          _panOffset.y = (destPanOffset.y - initialPanOffset.y) * now + initialPanOffset.y;
        }

        if (updateFn) {
          updateFn(now);
        }

        _applyCurrentZoomPan(now === 1);
      };

      if (speed) {
        _animateProp('customZoomTo', 0, 1, speed, easingFn || framework.easing.sine.inOut, onUpdate);
      } else {
        onUpdate(1);
      }
    }
  };
  /*>>core*/

  /*>>gestures*/

  /**
   * Mouse/touch/pointer event handlers.
   * 
   * separated from @core.js for readability
   */

  var MIN_SWIPE_DISTANCE = 30,
      DIRECTION_CHECK_OFFSET = 10; // amount of pixels to drag to determine direction of swipe

  var _gestureStartTime,
      _gestureCheckSpeedTime,
      // pool of objects that are used during dragging of zooming
  p = {},
      // first point
  p2 = {},
      // second point (for zoom gesture)
  delta = {},
      _currPoint = {},
      _startPoint = {},
      _currPointers = [],
      _startMainScrollPos = {},
      _releaseAnimData,
      _posPoints = [],
      // array of points during dragging, used to determine type of gesture
  _tempPoint = {},
      _isZoomingIn,
      _verticalDragInitiated,
      _oldAndroidTouchEndTimeout,
      _currZoomedItemIndex = 0,
      _centerPoint = _getEmptyPoint(),
      _lastReleaseTime = 0,
      _isDragging,
      // at least one pointer is down
  _isMultitouch,
      // at least two _pointers are down
  _zoomStarted,
      // zoom level changed during zoom gesture
  _moved,
      _dragAnimFrame,
      _mainScrollShifted,
      _currentPoints,
      // array of current touch points
  _isZooming,
      _currPointsDistance,
      _startPointsDistance,
      _currPanBounds,
      _mainScrollPos = _getEmptyPoint(),
      _currZoomElementStyle,
      _mainScrollAnimating,
      // true, if animation after swipe gesture is running
  _midZoomPoint = _getEmptyPoint(),
      _currCenterPoint = _getEmptyPoint(),
      _direction,
      _isFirstMove,
      _opacityChanged,
      _bgOpacity,
      _wasOverInitialZoom,
      _isEqualPoints = function _isEqualPoints(p1, p2) {
    return p1.x === p2.x && p1.y === p2.y;
  },
      _isNearbyPoints = function _isNearbyPoints(touch0, touch1) {
    return Math.abs(touch0.x - touch1.x) < DOUBLE_TAP_RADIUS && Math.abs(touch0.y - touch1.y) < DOUBLE_TAP_RADIUS;
  },
      _calculatePointsDistance = function _calculatePointsDistance(p1, p2) {
    _tempPoint.x = Math.abs(p1.x - p2.x);
    _tempPoint.y = Math.abs(p1.y - p2.y);
    return Math.sqrt(_tempPoint.x * _tempPoint.x + _tempPoint.y * _tempPoint.y);
  },
      _stopDragUpdateLoop = function _stopDragUpdateLoop() {
    if (_dragAnimFrame) {
      _cancelAF(_dragAnimFrame);

      _dragAnimFrame = null;
    }
  },
      _dragUpdateLoop = function _dragUpdateLoop() {
    if (_isDragging) {
      _dragAnimFrame = _requestAF(_dragUpdateLoop);

      _renderMovement();
    }
  },
      _canPan = function _canPan() {
    return !(_options.scaleMode === 'fit' && _currZoomLevel === self.currItem.initialZoomLevel);
  },
      // find the closest parent DOM element
  _closestElement = function _closestElement(el, fn) {
    if (!el || el === document) {
      return false;
    } // don't search elements above pswp__scroll-wrap


    if (el.getAttribute('class') && el.getAttribute('class').indexOf('pswp__scroll-wrap') > -1) {
      return false;
    }

    if (fn(el)) {
      return el;
    }

    return _closestElement(el.parentNode, fn);
  },
      _preventObj = {},
      _preventDefaultEventBehaviour = function _preventDefaultEventBehaviour(e, isDown) {
    _preventObj.prevent = !_closestElement(e.target, _options.isClickableElement);

    _shout('preventDragEvent', e, isDown, _preventObj);

    return _preventObj.prevent;
  },
      _convertTouchToPoint = function _convertTouchToPoint(touch, p) {
    p.x = touch.pageX;
    p.y = touch.pageY;
    p.id = touch.identifier;
    return p;
  },
      _findCenterOfPoints = function _findCenterOfPoints(p1, p2, pCenter) {
    pCenter.x = (p1.x + p2.x) * 0.5;
    pCenter.y = (p1.y + p2.y) * 0.5;
  },
      _pushPosPoint = function _pushPosPoint(time, x, y) {
    if (time - _gestureCheckSpeedTime > 50) {
      var o = _posPoints.length > 2 ? _posPoints.shift() : {};
      o.x = x;
      o.y = y;

      _posPoints.push(o);

      _gestureCheckSpeedTime = time;
    }
  },
      _calculateVerticalDragOpacityRatio = function _calculateVerticalDragOpacityRatio() {
    var yOffset = _panOffset.y - self.currItem.initialPosition.y; // difference between initial and current position

    return 1 - Math.abs(yOffset / (_viewportSize.y / 2));
  },
      // points pool, reused during touch events
  _ePoint1 = {},
      _ePoint2 = {},
      _tempPointsArr = [],
      _tempCounter,
      _getTouchPoints = function _getTouchPoints(e) {
    // clean up previous points, without recreating array
    while (_tempPointsArr.length > 0) {
      _tempPointsArr.pop();
    }

    if (!_pointerEventEnabled) {
      if (e.type.indexOf('touch') > -1) {
        if (e.touches && e.touches.length > 0) {
          _tempPointsArr[0] = _convertTouchToPoint(e.touches[0], _ePoint1);

          if (e.touches.length > 1) {
            _tempPointsArr[1] = _convertTouchToPoint(e.touches[1], _ePoint2);
          }
        }
      } else {
        _ePoint1.x = e.pageX;
        _ePoint1.y = e.pageY;
        _ePoint1.id = '';
        _tempPointsArr[0] = _ePoint1; //_ePoint1;
      }
    } else {
      _tempCounter = 0; // we can use forEach, as pointer events are supported only in modern browsers

      _currPointers.forEach(function (p) {
        if (_tempCounter === 0) {
          _tempPointsArr[0] = p;
        } else if (_tempCounter === 1) {
          _tempPointsArr[1] = p;
        }

        _tempCounter++;
      });
    }

    return _tempPointsArr;
  },
      _panOrMoveMainScroll = function _panOrMoveMainScroll(axis, delta) {
    var panFriction,
        overDiff = 0,
        newOffset = _panOffset[axis] + delta[axis],
        startOverDiff,
        dir = delta[axis] > 0,
        newMainScrollPosition = _mainScrollPos.x + delta.x,
        mainScrollDiff = _mainScrollPos.x - _startMainScrollPos.x,
        newPanPos,
        newMainScrollPos; // calculate fdistance over the bounds and friction

    if (newOffset > _currPanBounds.min[axis] || newOffset < _currPanBounds.max[axis]) {
      panFriction = _options.panEndFriction; // Linear increasing of friction, so at 1/4 of viewport it's at max value. 
      // Looks not as nice as was expected. Left for history.
      // panFriction = (1 - (_panOffset[axis] + delta[axis] + panBounds.min[axis]) / (_viewportSize[axis] / 4) );
    } else {
      panFriction = 1;
    }

    newOffset = _panOffset[axis] + delta[axis] * panFriction; // move main scroll or start panning

    if (_options.allowPanToNext || _currZoomLevel === self.currItem.initialZoomLevel) {
      if (!_currZoomElementStyle) {
        newMainScrollPos = newMainScrollPosition;
      } else if (_direction === 'h' && axis === 'x' && !_zoomStarted) {
        if (dir) {
          if (newOffset > _currPanBounds.min[axis]) {
            panFriction = _options.panEndFriction;
            overDiff = _currPanBounds.min[axis] - newOffset;
            startOverDiff = _currPanBounds.min[axis] - _startPanOffset[axis];
          } // drag right


          if ((startOverDiff <= 0 || mainScrollDiff < 0) && _getNumItems() > 1) {
            newMainScrollPos = newMainScrollPosition;

            if (mainScrollDiff < 0 && newMainScrollPosition > _startMainScrollPos.x) {
              newMainScrollPos = _startMainScrollPos.x;
            }
          } else {
            if (_currPanBounds.min.x !== _currPanBounds.max.x) {
              newPanPos = newOffset;
            }
          }
        } else {
          if (newOffset < _currPanBounds.max[axis]) {
            panFriction = _options.panEndFriction;
            overDiff = newOffset - _currPanBounds.max[axis];
            startOverDiff = _startPanOffset[axis] - _currPanBounds.max[axis];
          }

          if ((startOverDiff <= 0 || mainScrollDiff > 0) && _getNumItems() > 1) {
            newMainScrollPos = newMainScrollPosition;

            if (mainScrollDiff > 0 && newMainScrollPosition < _startMainScrollPos.x) {
              newMainScrollPos = _startMainScrollPos.x;
            }
          } else {
            if (_currPanBounds.min.x !== _currPanBounds.max.x) {
              newPanPos = newOffset;
            }
          }
        } //

      }

      if (axis === 'x') {
        if (newMainScrollPos !== undefined) {
          _moveMainScroll(newMainScrollPos, true);

          if (newMainScrollPos === _startMainScrollPos.x) {
            _mainScrollShifted = false;
          } else {
            _mainScrollShifted = true;
          }
        }

        if (_currPanBounds.min.x !== _currPanBounds.max.x) {
          if (newPanPos !== undefined) {
            _panOffset.x = newPanPos;
          } else if (!_mainScrollShifted) {
            _panOffset.x += delta.x * panFriction;
          }
        }

        return newMainScrollPos !== undefined;
      }
    }

    if (!_mainScrollAnimating) {
      if (!_mainScrollShifted) {
        if (_currZoomLevel > self.currItem.fitRatio) {
          _panOffset[axis] += delta[axis] * panFriction;
        }
      }
    }
  },
      // Pointerdown/touchstart/mousedown handler
  _onDragStart = function _onDragStart(e) {
    // Allow dragging only via left mouse button.
    // As this handler is not added in IE8 - we ignore e.which
    // 
    // http://www.quirksmode.org/js/events_properties.html
    // https://developer.mozilla.org/en-US/docs/Web/API/event.button
    if (e.type === 'mousedown' && e.button > 0) {
      return;
    }

    if (_initialZoomRunning) {
      e.preventDefault();
      return;
    }

    if (_oldAndroidTouchEndTimeout && e.type === 'mousedown') {
      return;
    }

    if (_preventDefaultEventBehaviour(e, true)) {
      e.preventDefault();
    }

    _shout('pointerDown');

    if (_pointerEventEnabled) {
      var pointerIndex = framework.arraySearch(_currPointers, e.pointerId, 'id');

      if (pointerIndex < 0) {
        pointerIndex = _currPointers.length;
      }

      _currPointers[pointerIndex] = {
        x: e.pageX,
        y: e.pageY,
        id: e.pointerId
      };
    }

    var startPointsList = _getTouchPoints(e),
        numPoints = startPointsList.length;

    _currentPoints = null;

    _stopAllAnimations(); // init drag


    if (!_isDragging || numPoints === 1) {
      _isDragging = _isFirstMove = true;
      framework.bind(window, _upMoveEvents, self);
      _isZoomingIn = _wasOverInitialZoom = _opacityChanged = _verticalDragInitiated = _mainScrollShifted = _moved = _isMultitouch = _zoomStarted = false;
      _direction = null;

      _shout('firstTouchStart', startPointsList);

      _equalizePoints(_startPanOffset, _panOffset);

      _currPanDist.x = _currPanDist.y = 0;

      _equalizePoints(_currPoint, startPointsList[0]);

      _equalizePoints(_startPoint, _currPoint); //_equalizePoints(_startMainScrollPos, _mainScrollPos);


      _startMainScrollPos.x = _slideSize.x * _currPositionIndex;
      _posPoints = [{
        x: _currPoint.x,
        y: _currPoint.y
      }];
      _gestureCheckSpeedTime = _gestureStartTime = _getCurrentTime(); //_mainScrollAnimationEnd(true);

      _calculatePanBounds(_currZoomLevel, true); // Start rendering


      _stopDragUpdateLoop();

      _dragUpdateLoop();
    } // init zoom


    if (!_isZooming && numPoints > 1 && !_mainScrollAnimating && !_mainScrollShifted) {
      _startZoomLevel = _currZoomLevel;
      _zoomStarted = false; // true if zoom changed at least once

      _isZooming = _isMultitouch = true;
      _currPanDist.y = _currPanDist.x = 0;

      _equalizePoints(_startPanOffset, _panOffset);

      _equalizePoints(p, startPointsList[0]);

      _equalizePoints(p2, startPointsList[1]);

      _findCenterOfPoints(p, p2, _currCenterPoint);

      _midZoomPoint.x = Math.abs(_currCenterPoint.x) - _panOffset.x;
      _midZoomPoint.y = Math.abs(_currCenterPoint.y) - _panOffset.y;
      _currPointsDistance = _startPointsDistance = _calculatePointsDistance(p, p2);
    }
  },
      // Pointermove/touchmove/mousemove handler
  _onDragMove = function _onDragMove(e) {
    e.preventDefault();

    if (_pointerEventEnabled) {
      var pointerIndex = framework.arraySearch(_currPointers, e.pointerId, 'id');

      if (pointerIndex > -1) {
        var p = _currPointers[pointerIndex];
        p.x = e.pageX;
        p.y = e.pageY;
      }
    }

    if (_isDragging) {
      var touchesList = _getTouchPoints(e);

      if (!_direction && !_moved && !_isZooming) {
        if (_mainScrollPos.x !== _slideSize.x * _currPositionIndex) {
          // if main scroll position is shifted – direction is always horizontal
          _direction = 'h';
        } else {
          var diff = Math.abs(touchesList[0].x - _currPoint.x) - Math.abs(touchesList[0].y - _currPoint.y); // check the direction of movement

          if (Math.abs(diff) >= DIRECTION_CHECK_OFFSET) {
            _direction = diff > 0 ? 'h' : 'v';
            _currentPoints = touchesList;
          }
        }
      } else {
        _currentPoints = touchesList;
      }
    }
  },
      // 
  _renderMovement = function _renderMovement() {
    if (!_currentPoints) {
      return;
    }

    var numPoints = _currentPoints.length;

    if (numPoints === 0) {
      return;
    }

    _equalizePoints(p, _currentPoints[0]);

    delta.x = p.x - _currPoint.x;
    delta.y = p.y - _currPoint.y;

    if (_isZooming && numPoints > 1) {
      // Handle behaviour for more than 1 point
      _currPoint.x = p.x;
      _currPoint.y = p.y; // check if one of two points changed

      if (!delta.x && !delta.y && _isEqualPoints(_currentPoints[1], p2)) {
        return;
      }

      _equalizePoints(p2, _currentPoints[1]);

      if (!_zoomStarted) {
        _zoomStarted = true;

        _shout('zoomGestureStarted');
      } // Distance between two points


      var pointsDistance = _calculatePointsDistance(p, p2);

      var zoomLevel = _calculateZoomLevel(pointsDistance); // slightly over the of initial zoom level


      if (zoomLevel > self.currItem.initialZoomLevel + self.currItem.initialZoomLevel / 15) {
        _wasOverInitialZoom = true;
      } // Apply the friction if zoom level is out of the bounds


      var zoomFriction = 1,
          minZoomLevel = _getMinZoomLevel(),
          maxZoomLevel = _getMaxZoomLevel();

      if (zoomLevel < minZoomLevel) {
        if (_options.pinchToClose && !_wasOverInitialZoom && _startZoomLevel <= self.currItem.initialZoomLevel) {
          // fade out background if zooming out
          var minusDiff = minZoomLevel - zoomLevel;
          var percent = 1 - minusDiff / (minZoomLevel / 1.2);

          _applyBgOpacity(percent);

          _shout('onPinchClose', percent);

          _opacityChanged = true;
        } else {
          zoomFriction = (minZoomLevel - zoomLevel) / minZoomLevel;

          if (zoomFriction > 1) {
            zoomFriction = 1;
          }

          zoomLevel = minZoomLevel - zoomFriction * (minZoomLevel / 3);
        }
      } else if (zoomLevel > maxZoomLevel) {
        // 1.5 - extra zoom level above the max. E.g. if max is x6, real max 6 + 1.5 = 7.5
        zoomFriction = (zoomLevel - maxZoomLevel) / (minZoomLevel * 6);

        if (zoomFriction > 1) {
          zoomFriction = 1;
        }

        zoomLevel = maxZoomLevel + zoomFriction * minZoomLevel;
      }

      if (zoomFriction < 0) {
        zoomFriction = 0;
      } // distance between touch points after friction is applied


      _currPointsDistance = pointsDistance; // _centerPoint - The point in the middle of two pointers

      _findCenterOfPoints(p, p2, _centerPoint); // paning with two pointers pressed


      _currPanDist.x += _centerPoint.x - _currCenterPoint.x;
      _currPanDist.y += _centerPoint.y - _currCenterPoint.y;

      _equalizePoints(_currCenterPoint, _centerPoint);

      _panOffset.x = _calculatePanOffset('x', zoomLevel);
      _panOffset.y = _calculatePanOffset('y', zoomLevel);
      _isZoomingIn = zoomLevel > _currZoomLevel;
      _currZoomLevel = zoomLevel;

      _applyCurrentZoomPan();
    } else {
      // handle behaviour for one point (dragging or panning)
      if (!_direction) {
        return;
      }

      if (_isFirstMove) {
        _isFirstMove = false; // subtract drag distance that was used during the detection direction  

        if (Math.abs(delta.x) >= DIRECTION_CHECK_OFFSET) {
          delta.x -= _currentPoints[0].x - _startPoint.x;
        }

        if (Math.abs(delta.y) >= DIRECTION_CHECK_OFFSET) {
          delta.y -= _currentPoints[0].y - _startPoint.y;
        }
      }

      _currPoint.x = p.x;
      _currPoint.y = p.y; // do nothing if pointers position hasn't changed

      if (delta.x === 0 && delta.y === 0) {
        return;
      }

      if (_direction === 'v' && _options.closeOnVerticalDrag) {
        if (!_canPan()) {
          _currPanDist.y += delta.y;
          _panOffset.y += delta.y;

          var opacityRatio = _calculateVerticalDragOpacityRatio();

          _verticalDragInitiated = true;

          _shout('onVerticalDrag', opacityRatio);

          _applyBgOpacity(opacityRatio);

          _applyCurrentZoomPan();

          return;
        }
      }

      _pushPosPoint(_getCurrentTime(), p.x, p.y);

      _moved = true;
      _currPanBounds = self.currItem.bounds;

      var mainScrollChanged = _panOrMoveMainScroll('x', delta);

      if (!mainScrollChanged) {
        _panOrMoveMainScroll('y', delta);

        _roundPoint(_panOffset);

        _applyCurrentZoomPan();
      }
    }
  },
      // Pointerup/pointercancel/touchend/touchcancel/mouseup event handler
  _onDragRelease = function _onDragRelease(e) {
    if (_features.isOldAndroid) {
      if (_oldAndroidTouchEndTimeout && e.type === 'mouseup') {
        return;
      } // on Android (v4.1, 4.2, 4.3 & possibly older) 
      // ghost mousedown/up event isn't preventable via e.preventDefault,
      // which causes fake mousedown event
      // so we block mousedown/up for 600ms


      if (e.type.indexOf('touch') > -1) {
        clearTimeout(_oldAndroidTouchEndTimeout);
        _oldAndroidTouchEndTimeout = setTimeout(function () {
          _oldAndroidTouchEndTimeout = 0;
        }, 600);
      }
    }

    _shout('pointerUp');

    if (_preventDefaultEventBehaviour(e, false)) {
      e.preventDefault();
    }

    var releasePoint;

    if (_pointerEventEnabled) {
      var pointerIndex = framework.arraySearch(_currPointers, e.pointerId, 'id');

      if (pointerIndex > -1) {
        releasePoint = _currPointers.splice(pointerIndex, 1)[0];

        if (navigator.msPointerEnabled) {
          var MSPOINTER_TYPES = {
            4: 'mouse',
            // event.MSPOINTER_TYPE_MOUSE
            2: 'touch',
            // event.MSPOINTER_TYPE_TOUCH 
            3: 'pen' // event.MSPOINTER_TYPE_PEN

          };
          releasePoint.type = MSPOINTER_TYPES[e.pointerType];

          if (!releasePoint.type) {
            releasePoint.type = e.pointerType || 'mouse';
          }
        } else {
          releasePoint.type = e.pointerType || 'mouse';
        }
      }
    }

    var touchList = _getTouchPoints(e),
        gestureType,
        numPoints = touchList.length;

    if (e.type === 'mouseup') {
      numPoints = 0;
    } // Do nothing if there were 3 touch points or more


    if (numPoints === 2) {
      _currentPoints = null;
      return true;
    } // if second pointer released


    if (numPoints === 1) {
      _equalizePoints(_startPoint, touchList[0]);
    } // pointer hasn't moved, send "tap release" point


    if (numPoints === 0 && !_direction && !_mainScrollAnimating) {
      if (!releasePoint) {
        if (e.type === 'mouseup') {
          releasePoint = {
            x: e.pageX,
            y: e.pageY,
            type: 'mouse'
          };
        } else if (e.changedTouches && e.changedTouches[0]) {
          releasePoint = {
            x: e.changedTouches[0].pageX,
            y: e.changedTouches[0].pageY,
            type: 'touch'
          };
        }
      }

      _shout('touchRelease', e, releasePoint);
    } // Difference in time between releasing of two last touch points (zoom gesture)


    var releaseTimeDiff = -1; // Gesture completed, no pointers left

    if (numPoints === 0) {
      _isDragging = false;
      framework.unbind(window, _upMoveEvents, self);

      _stopDragUpdateLoop();

      if (_isZooming) {
        // Two points released at the same time
        releaseTimeDiff = 0;
      } else if (_lastReleaseTime !== -1) {
        releaseTimeDiff = _getCurrentTime() - _lastReleaseTime;
      }
    }

    _lastReleaseTime = numPoints === 1 ? _getCurrentTime() : -1;

    if (releaseTimeDiff !== -1 && releaseTimeDiff < 150) {
      gestureType = 'zoom';
    } else {
      gestureType = 'swipe';
    }

    if (_isZooming && numPoints < 2) {
      _isZooming = false; // Only second point released

      if (numPoints === 1) {
        gestureType = 'zoomPointerUp';
      }

      _shout('zoomGestureEnded');
    }

    _currentPoints = null;

    if (!_moved && !_zoomStarted && !_mainScrollAnimating && !_verticalDragInitiated) {
      // nothing to animate
      return;
    }

    _stopAllAnimations();

    if (!_releaseAnimData) {
      _releaseAnimData = _initDragReleaseAnimationData();
    }

    _releaseAnimData.calculateSwipeSpeed('x');

    if (_verticalDragInitiated) {
      var opacityRatio = _calculateVerticalDragOpacityRatio();

      if (opacityRatio < _options.verticalDragRange) {
        self.close();
      } else {
        var initalPanY = _panOffset.y,
            initialBgOpacity = _bgOpacity;

        _animateProp('verticalDrag', 0, 1, 300, framework.easing.cubic.out, function (now) {
          _panOffset.y = (self.currItem.initialPosition.y - initalPanY) * now + initalPanY;

          _applyBgOpacity((1 - initialBgOpacity) * now + initialBgOpacity);

          _applyCurrentZoomPan();
        });

        _shout('onVerticalDrag', 1);
      }

      return;
    } // main scroll 


    if ((_mainScrollShifted || _mainScrollAnimating) && numPoints === 0) {
      var itemChanged = _finishSwipeMainScrollGesture(gestureType, _releaseAnimData);

      if (itemChanged) {
        return;
      }

      gestureType = 'zoomPointerUp';
    } // prevent zoom/pan animation when main scroll animation runs


    if (_mainScrollAnimating) {
      return;
    } // Complete simple zoom gesture (reset zoom level if it's out of the bounds)  


    if (gestureType !== 'swipe') {
      _completeZoomGesture();

      return;
    } // Complete pan gesture if main scroll is not shifted, and it's possible to pan current image


    if (!_mainScrollShifted && _currZoomLevel > self.currItem.fitRatio) {
      _completePanGesture(_releaseAnimData);
    }
  },
      // Returns object with data about gesture
  // It's created only once and then reused
  _initDragReleaseAnimationData = function _initDragReleaseAnimationData() {
    // temp local vars
    var lastFlickDuration, tempReleasePos; // s = this

    var s = {
      lastFlickOffset: {},
      lastFlickDist: {},
      lastFlickSpeed: {},
      slowDownRatio: {},
      slowDownRatioReverse: {},
      speedDecelerationRatio: {},
      speedDecelerationRatioAbs: {},
      distanceOffset: {},
      backAnimDestination: {},
      backAnimStarted: {},
      calculateSwipeSpeed: function calculateSwipeSpeed(axis) {
        if (_posPoints.length > 1) {
          lastFlickDuration = _getCurrentTime() - _gestureCheckSpeedTime + 50;
          tempReleasePos = _posPoints[_posPoints.length - 2][axis];
        } else {
          lastFlickDuration = _getCurrentTime() - _gestureStartTime; // total gesture duration

          tempReleasePos = _startPoint[axis];
        }

        s.lastFlickOffset[axis] = _currPoint[axis] - tempReleasePos;
        s.lastFlickDist[axis] = Math.abs(s.lastFlickOffset[axis]);

        if (s.lastFlickDist[axis] > 20) {
          s.lastFlickSpeed[axis] = s.lastFlickOffset[axis] / lastFlickDuration;
        } else {
          s.lastFlickSpeed[axis] = 0;
        }

        if (Math.abs(s.lastFlickSpeed[axis]) < 0.1) {
          s.lastFlickSpeed[axis] = 0;
        }

        s.slowDownRatio[axis] = 0.95;
        s.slowDownRatioReverse[axis] = 1 - s.slowDownRatio[axis];
        s.speedDecelerationRatio[axis] = 1;
      },
      calculateOverBoundsAnimOffset: function calculateOverBoundsAnimOffset(axis, speed) {
        if (!s.backAnimStarted[axis]) {
          if (_panOffset[axis] > _currPanBounds.min[axis]) {
            s.backAnimDestination[axis] = _currPanBounds.min[axis];
          } else if (_panOffset[axis] < _currPanBounds.max[axis]) {
            s.backAnimDestination[axis] = _currPanBounds.max[axis];
          }

          if (s.backAnimDestination[axis] !== undefined) {
            s.slowDownRatio[axis] = 0.7;
            s.slowDownRatioReverse[axis] = 1 - s.slowDownRatio[axis];

            if (s.speedDecelerationRatioAbs[axis] < 0.05) {
              s.lastFlickSpeed[axis] = 0;
              s.backAnimStarted[axis] = true;

              _animateProp('bounceZoomPan' + axis, _panOffset[axis], s.backAnimDestination[axis], speed || 300, framework.easing.sine.out, function (pos) {
                _panOffset[axis] = pos;

                _applyCurrentZoomPan();
              });
            }
          }
        }
      },
      // Reduces the speed by slowDownRatio (per 10ms)
      calculateAnimOffset: function calculateAnimOffset(axis) {
        if (!s.backAnimStarted[axis]) {
          s.speedDecelerationRatio[axis] = s.speedDecelerationRatio[axis] * (s.slowDownRatio[axis] + s.slowDownRatioReverse[axis] - s.slowDownRatioReverse[axis] * s.timeDiff / 10);
          s.speedDecelerationRatioAbs[axis] = Math.abs(s.lastFlickSpeed[axis] * s.speedDecelerationRatio[axis]);
          s.distanceOffset[axis] = s.lastFlickSpeed[axis] * s.speedDecelerationRatio[axis] * s.timeDiff;
          _panOffset[axis] += s.distanceOffset[axis];
        }
      },
      panAnimLoop: function panAnimLoop() {
        if (_animations.zoomPan) {
          _animations.zoomPan.raf = _requestAF(s.panAnimLoop);
          s.now = _getCurrentTime();
          s.timeDiff = s.now - s.lastNow;
          s.lastNow = s.now;
          s.calculateAnimOffset('x');
          s.calculateAnimOffset('y');

          _applyCurrentZoomPan();

          s.calculateOverBoundsAnimOffset('x');
          s.calculateOverBoundsAnimOffset('y');

          if (s.speedDecelerationRatioAbs.x < 0.05 && s.speedDecelerationRatioAbs.y < 0.05) {
            // round pan position
            _panOffset.x = Math.round(_panOffset.x);
            _panOffset.y = Math.round(_panOffset.y);

            _applyCurrentZoomPan();

            _stopAnimation('zoomPan');

            return;
          }
        }
      }
    };
    return s;
  },
      _completePanGesture = function _completePanGesture(animData) {
    // calculate swipe speed for Y axis (paanning)
    animData.calculateSwipeSpeed('y');
    _currPanBounds = self.currItem.bounds;
    animData.backAnimDestination = {};
    animData.backAnimStarted = {}; // Avoid acceleration animation if speed is too low

    if (Math.abs(animData.lastFlickSpeed.x) <= 0.05 && Math.abs(animData.lastFlickSpeed.y) <= 0.05) {
      animData.speedDecelerationRatioAbs.x = animData.speedDecelerationRatioAbs.y = 0; // Run pan drag release animation. E.g. if you drag image and release finger without momentum.

      animData.calculateOverBoundsAnimOffset('x');
      animData.calculateOverBoundsAnimOffset('y');
      return true;
    } // Animation loop that controls the acceleration after pan gesture ends


    _registerStartAnimation('zoomPan');

    animData.lastNow = _getCurrentTime();
    animData.panAnimLoop();
  },
      _finishSwipeMainScrollGesture = function _finishSwipeMainScrollGesture(gestureType, _releaseAnimData) {
    var itemChanged;

    if (!_mainScrollAnimating) {
      _currZoomedItemIndex = _currentItemIndex;
    }

    var itemsDiff;

    if (gestureType === 'swipe') {
      var totalShiftDist = _currPoint.x - _startPoint.x,
          isFastLastFlick = _releaseAnimData.lastFlickDist.x < 10; // if container is shifted for more than MIN_SWIPE_DISTANCE, 
      // and last flick gesture was in right direction

      if (totalShiftDist > MIN_SWIPE_DISTANCE && (isFastLastFlick || _releaseAnimData.lastFlickOffset.x > 20)) {
        // go to prev item
        itemsDiff = -1;
      } else if (totalShiftDist < -MIN_SWIPE_DISTANCE && (isFastLastFlick || _releaseAnimData.lastFlickOffset.x < -20)) {
        // go to next item
        itemsDiff = 1;
      }
    }

    var nextCircle;

    if (itemsDiff) {
      _currentItemIndex += itemsDiff;

      if (_currentItemIndex < 0) {
        _currentItemIndex = _options.loop ? _getNumItems() - 1 : 0;
        nextCircle = true;
      } else if (_currentItemIndex >= _getNumItems()) {
        _currentItemIndex = _options.loop ? 0 : _getNumItems() - 1;
        nextCircle = true;
      }

      if (!nextCircle || _options.loop) {
        _indexDiff += itemsDiff;
        _currPositionIndex -= itemsDiff;
        itemChanged = true;
      }
    }

    var animateToX = _slideSize.x * _currPositionIndex;
    var animateToDist = Math.abs(animateToX - _mainScrollPos.x);
    var finishAnimDuration;

    if (!itemChanged && animateToX > _mainScrollPos.x !== _releaseAnimData.lastFlickSpeed.x > 0) {
      // "return to current" duration, e.g. when dragging from slide 0 to -1
      finishAnimDuration = 333;
    } else {
      finishAnimDuration = Math.abs(_releaseAnimData.lastFlickSpeed.x) > 0 ? animateToDist / Math.abs(_releaseAnimData.lastFlickSpeed.x) : 333;
      finishAnimDuration = Math.min(finishAnimDuration, 400);
      finishAnimDuration = Math.max(finishAnimDuration, 250);
    }

    if (_currZoomedItemIndex === _currentItemIndex) {
      itemChanged = false;
    }

    _mainScrollAnimating = true;

    _shout('mainScrollAnimStart');

    _animateProp('mainScroll', _mainScrollPos.x, animateToX, finishAnimDuration, framework.easing.cubic.out, _moveMainScroll, function () {
      _stopAllAnimations();

      _mainScrollAnimating = false;
      _currZoomedItemIndex = -1;

      if (itemChanged || _currZoomedItemIndex !== _currentItemIndex) {
        self.updateCurrItem();
      }

      _shout('mainScrollAnimComplete');
    });

    if (itemChanged) {
      self.updateCurrItem(true);
    }

    return itemChanged;
  },
      _calculateZoomLevel = function _calculateZoomLevel(touchesDistance) {
    return 1 / _startPointsDistance * touchesDistance * _startZoomLevel;
  },
      // Resets zoom if it's out of bounds
  _completeZoomGesture = function _completeZoomGesture() {
    var destZoomLevel = _currZoomLevel,
        minZoomLevel = _getMinZoomLevel(),
        maxZoomLevel = _getMaxZoomLevel();

    if (_currZoomLevel < minZoomLevel) {
      destZoomLevel = minZoomLevel;
    } else if (_currZoomLevel > maxZoomLevel) {
      destZoomLevel = maxZoomLevel;
    }

    var destOpacity = 1,
        onUpdate,
        initialOpacity = _bgOpacity;

    if (_opacityChanged && !_isZoomingIn && !_wasOverInitialZoom && _currZoomLevel < minZoomLevel) {
      //_closedByScroll = true;
      self.close();
      return true;
    }

    if (_opacityChanged) {
      onUpdate = function onUpdate(now) {
        _applyBgOpacity((destOpacity - initialOpacity) * now + initialOpacity);
      };
    }

    self.zoomTo(destZoomLevel, 0, 200, framework.easing.cubic.out, onUpdate);
    return true;
  };

  _registerModule('Gestures', {
    publicMethods: {
      initGestures: function initGestures() {
        // helper function that builds touch/pointer/mouse events
        var addEventNames = function addEventNames(pref, down, move, up, cancel) {
          _dragStartEvent = pref + down;
          _dragMoveEvent = pref + move;
          _dragEndEvent = pref + up;

          if (cancel) {
            _dragCancelEvent = pref + cancel;
          } else {
            _dragCancelEvent = '';
          }
        };

        _pointerEventEnabled = _features.pointerEvent;

        if (_pointerEventEnabled && _features.touch) {
          // we don't need touch events, if browser supports pointer events
          _features.touch = false;
        }

        if (_pointerEventEnabled) {
          if (navigator.msPointerEnabled) {
            // IE10 pointer events are case-sensitive
            addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
          } else {
            addEventNames('pointer', 'down', 'move', 'up', 'cancel');
          }
        } else if (_features.touch) {
          addEventNames('touch', 'start', 'move', 'end', 'cancel');
          _likelyTouchDevice = true;
        } else {
          addEventNames('mouse', 'down', 'move', 'up');
        }

        _upMoveEvents = _dragMoveEvent + ' ' + _dragEndEvent + ' ' + _dragCancelEvent;
        _downEvents = _dragStartEvent;

        if (_pointerEventEnabled && !_likelyTouchDevice) {
          _likelyTouchDevice = navigator.maxTouchPoints > 1 || navigator.msMaxTouchPoints > 1;
        } // make variable public


        self.likelyTouchDevice = _likelyTouchDevice;
        _globalEventHandlers[_dragStartEvent] = _onDragStart;
        _globalEventHandlers[_dragMoveEvent] = _onDragMove;
        _globalEventHandlers[_dragEndEvent] = _onDragRelease; // the Kraken

        if (_dragCancelEvent) {
          _globalEventHandlers[_dragCancelEvent] = _globalEventHandlers[_dragEndEvent];
        } // Bind mouse events on device with detected hardware touch support, in case it supports multiple types of input.


        if (_features.touch) {
          _downEvents += ' mousedown';
          _upMoveEvents += ' mousemove mouseup';
          _globalEventHandlers.mousedown = _globalEventHandlers[_dragStartEvent];
          _globalEventHandlers.mousemove = _globalEventHandlers[_dragMoveEvent];
          _globalEventHandlers.mouseup = _globalEventHandlers[_dragEndEvent];
        }

        if (!_likelyTouchDevice) {
          // don't allow pan to next slide from zoomed state on Desktop
          _options.allowPanToNext = false;
        }
      }
    }
  });
  /*>>gestures*/

  /*>>show-hide-transition*/

  /**
   * show-hide-transition.js:
   *
   * Manages initial opening or closing transition.
   *
   * If you're not planning to use transition for gallery at all,
   * you may set options hideAnimationDuration and showAnimationDuration to 0,
   * and just delete startAnimation function.
   * 
   */


  var _showOrHideTimeout,
      _showOrHide = function _showOrHide(item, img, out, completeFn) {
    if (_showOrHideTimeout) {
      clearTimeout(_showOrHideTimeout);
    }

    _initialZoomRunning = true;
    _initialContentSet = true; // dimensions of small thumbnail {x:,y:,w:}.
    // Height is optional, as calculated based on large image.

    var thumbBounds;

    if (item.initialLayout) {
      thumbBounds = item.initialLayout;
      item.initialLayout = null;
    } else {
      thumbBounds = _options.getThumbBoundsFn && _options.getThumbBoundsFn(_currentItemIndex);
    }

    var duration = out ? _options.hideAnimationDuration : _options.showAnimationDuration;

    var onComplete = function onComplete() {
      _stopAnimation('initialZoom');

      if (!out) {
        _applyBgOpacity(1);

        if (img) {
          img.style.display = 'block';
        }

        framework.addClass(template, 'pswp--animated-in');

        _shout('initialZoom' + (out ? 'OutEnd' : 'InEnd'));
      } else {
        self.template.removeAttribute('style');
        self.bg.removeAttribute('style');
      }

      if (completeFn) {
        completeFn();
      }

      _initialZoomRunning = false;
    }; // if bounds aren't provided, just open gallery without animation


    if (!duration || !thumbBounds || thumbBounds.x === undefined) {
      _shout('initialZoom' + (out ? 'Out' : 'In'));

      _currZoomLevel = item.initialZoomLevel;

      _equalizePoints(_panOffset, item.initialPosition);

      _applyCurrentZoomPan();

      template.style.opacity = out ? 0 : 1;

      _applyBgOpacity(1);

      if (duration) {
        setTimeout(function () {
          onComplete();
        }, duration);
      } else {
        onComplete();
      }

      return;
    }

    var startAnimation = function startAnimation() {
      var closeWithRaf = _closedByScroll,
          fadeEverything = !self.currItem.src || self.currItem.loadError || _options.showHideOpacity; // apply hw-acceleration to image

      if (item.miniImg) {
        item.miniImg.style.webkitBackfaceVisibility = 'hidden';
      }

      if (!out) {
        _currZoomLevel = thumbBounds.w / item.w;
        _panOffset.x = thumbBounds.x;
        _panOffset.y = thumbBounds.y - _initalWindowScrollY;
        self[fadeEverything ? 'template' : 'bg'].style.opacity = 0.001;

        _applyCurrentZoomPan();
      }

      _registerStartAnimation('initialZoom');

      if (out && !closeWithRaf) {
        framework.removeClass(template, 'pswp--animated-in');
      }

      if (fadeEverything) {
        if (out) {
          framework[(closeWithRaf ? 'remove' : 'add') + 'Class'](template, 'pswp--animate_opacity');
        } else {
          setTimeout(function () {
            framework.addClass(template, 'pswp--animate_opacity');
          }, 30);
        }
      }

      _showOrHideTimeout = setTimeout(function () {
        _shout('initialZoom' + (out ? 'Out' : 'In'));

        if (!out) {
          // "in" animation always uses CSS transitions (instead of rAF).
          // CSS transition work faster here, 
          // as developer may also want to animate other things, 
          // like ui on top of sliding area, which can be animated just via CSS
          _currZoomLevel = item.initialZoomLevel;

          _equalizePoints(_panOffset, item.initialPosition);

          _applyCurrentZoomPan();

          _applyBgOpacity(1);

          if (fadeEverything) {
            template.style.opacity = 1;
          } else {
            _applyBgOpacity(1);
          }

          _showOrHideTimeout = setTimeout(onComplete, duration + 20);
        } else {
          // "out" animation uses rAF only when PhotoSwipe is closed by browser scroll, to recalculate position
          var destZoomLevel = thumbBounds.w / item.w,
              initialPanOffset = {
            x: _panOffset.x,
            y: _panOffset.y
          },
              initialZoomLevel = _currZoomLevel,
              initalBgOpacity = _bgOpacity,
              onUpdate = function onUpdate(now) {
            if (now === 1) {
              _currZoomLevel = destZoomLevel;
              _panOffset.x = thumbBounds.x;
              _panOffset.y = thumbBounds.y - _currentWindowScrollY;
            } else {
              _currZoomLevel = (destZoomLevel - initialZoomLevel) * now + initialZoomLevel;
              _panOffset.x = (thumbBounds.x - initialPanOffset.x) * now + initialPanOffset.x;
              _panOffset.y = (thumbBounds.y - _currentWindowScrollY - initialPanOffset.y) * now + initialPanOffset.y;
            }

            _applyCurrentZoomPan();

            if (fadeEverything) {
              template.style.opacity = 1 - now;
            } else {
              _applyBgOpacity(initalBgOpacity - now * initalBgOpacity);
            }
          };

          if (closeWithRaf) {
            _animateProp('initialZoom', 0, 1, duration, framework.easing.cubic.out, onUpdate, onComplete);
          } else {
            onUpdate(1);
            _showOrHideTimeout = setTimeout(onComplete, duration + 20);
          }
        }
      }, out ? 25 : 90); // Main purpose of this delay is to give browser time to paint and
      // create composite layers of PhotoSwipe UI parts (background, controls, caption, arrows).
      // Which avoids lag at the beginning of scale transition.
    };

    startAnimation();
  };
  /*>>show-hide-transition*/

  /*>>items-controller*/

  /**
  *
  * Controller manages gallery items, their dimensions, and their content.
  * 
  */


  var _items,
      _tempPanAreaSize = {},
      _imagesToAppendPool = [],
      _initialContentSet,
      _initialZoomRunning,
      _controllerDefaultOptions = {
    index: 0,
    errorMsg: '<div class="pswp__error-msg"><a href="%url%" target="_blank">The image</a> could not be loaded.</div>',
    forceProgressiveLoading: false,
    // TODO
    preload: [1, 1],
    getNumItemsFn: function getNumItemsFn() {
      return _items.length;
    }
  };

  var _getItemAt,
      _getNumItems,
      _initialIsLoop,
      _getZeroBounds = function _getZeroBounds() {
    return {
      center: {
        x: 0,
        y: 0
      },
      max: {
        x: 0,
        y: 0
      },
      min: {
        x: 0,
        y: 0
      }
    };
  },
      _calculateSingleItemPanBounds = function _calculateSingleItemPanBounds(item, realPanElementW, realPanElementH) {
    var bounds = item.bounds; // position of element when it's centered

    bounds.center.x = Math.round((_tempPanAreaSize.x - realPanElementW) / 2);
    bounds.center.y = Math.round((_tempPanAreaSize.y - realPanElementH) / 2) + item.vGap.top; // maximum pan position

    bounds.max.x = realPanElementW > _tempPanAreaSize.x ? Math.round(_tempPanAreaSize.x - realPanElementW) : bounds.center.x;
    bounds.max.y = realPanElementH > _tempPanAreaSize.y ? Math.round(_tempPanAreaSize.y - realPanElementH) + item.vGap.top : bounds.center.y; // minimum pan position

    bounds.min.x = realPanElementW > _tempPanAreaSize.x ? 0 : bounds.center.x;
    bounds.min.y = realPanElementH > _tempPanAreaSize.y ? item.vGap.top : bounds.center.y;
  },
      _calculateItemSize = function _calculateItemSize(item, viewportSize, zoomLevel) {
    if (item.src && !item.loadError) {
      var isInitial = !zoomLevel;

      if (isInitial) {
        if (!item.vGap) {
          item.vGap = {
            top: 0,
            bottom: 0
          };
        } // allows overriding vertical margin for individual items


        _shout('parseVerticalMargin', item);
      }

      _tempPanAreaSize.x = viewportSize.x;
      _tempPanAreaSize.y = viewportSize.y - item.vGap.top - item.vGap.bottom;

      if (isInitial) {
        var hRatio = _tempPanAreaSize.x / item.w;
        var vRatio = _tempPanAreaSize.y / item.h;
        item.fitRatio = hRatio < vRatio ? hRatio : vRatio; //item.fillRatio = hRatio > vRatio ? hRatio : vRatio;

        var scaleMode = _options.scaleMode;

        if (scaleMode === 'orig') {
          zoomLevel = 1;
        } else if (scaleMode === 'fit') {
          zoomLevel = item.fitRatio;
        }

        if (zoomLevel > 1) {
          zoomLevel = 1;
        }

        item.initialZoomLevel = zoomLevel;

        if (!item.bounds) {
          // reuse bounds object
          item.bounds = _getZeroBounds();
        }
      }

      if (!zoomLevel) {
        return;
      }

      _calculateSingleItemPanBounds(item, item.w * zoomLevel, item.h * zoomLevel);

      if (isInitial && zoomLevel === item.initialZoomLevel) {
        item.initialPosition = item.bounds.center;
      }

      return item.bounds;
    } else {
      item.w = item.h = 0;
      item.initialZoomLevel = item.fitRatio = 1;
      item.bounds = _getZeroBounds();
      item.initialPosition = item.bounds.center; // if it's not image, we return zero bounds (content is not zoomable)

      return item.bounds;
    }
  },
      _appendImage = function _appendImage(index, item, baseDiv, img, preventAnimation, keepPlaceholder) {
    if (item.loadError) {
      return;
    }

    if (img) {
      item.imageAppended = true;

      _setImageSize(item, img, item === self.currItem && _renderMaxResolution);

      baseDiv.appendChild(img);

      if (keepPlaceholder) {
        setTimeout(function () {
          if (item && item.loaded && item.placeholder) {
            item.placeholder.style.display = 'none';
            item.placeholder = null;
          }
        }, 500);
      }
    }
  },
      _preloadImage = function _preloadImage(item) {
    item.loading = true;
    item.loaded = false;
    var img = item.img = framework.createEl('pswp__img', 'img');

    var onComplete = function onComplete() {
      item.loading = false;
      item.loaded = true;

      if (item.loadComplete) {
        item.loadComplete(item);
      } else {
        item.img = null; // no need to store image object
      }

      img.onload = img.onerror = null;
      img = null;
    };

    img.onload = onComplete;

    img.onerror = function () {
      item.loadError = true;
      onComplete();
    };

    img.src = item.src; // + '?a=' + Math.random();

    return img;
  },
      _checkForError = function _checkForError(item, cleanUp) {
    if (item.src && item.loadError && item.container) {
      if (cleanUp) {
        item.container.innerHTML = '';
      }

      item.container.innerHTML = _options.errorMsg.replace('%url%', item.src);
      return true;
    }
  },
      _setImageSize = function _setImageSize(item, img, maxRes) {
    if (!item.src) {
      return;
    }

    if (!img) {
      img = item.container.lastChild;
    }

    var w = maxRes ? item.w : Math.round(item.w * item.fitRatio),
        h = maxRes ? item.h : Math.round(item.h * item.fitRatio);

    if (item.placeholder && !item.loaded) {
      item.placeholder.style.width = w + 'px';
      item.placeholder.style.height = h + 'px';
    }

    img.style.width = w + 'px';
    img.style.height = h + 'px';
  },
      _appendImagesPool = function _appendImagesPool() {
    if (_imagesToAppendPool.length) {
      var poolItem;

      for (var i = 0; i < _imagesToAppendPool.length; i++) {
        poolItem = _imagesToAppendPool[i];

        if (poolItem.holder.index === poolItem.index) {
          _appendImage(poolItem.index, poolItem.item, poolItem.baseDiv, poolItem.img, false, poolItem.clearPlaceholder);
        }
      }

      _imagesToAppendPool = [];
    }
  };

  _registerModule('Controller', {
    publicMethods: {
      lazyLoadItem: function lazyLoadItem(index) {
        index = _getLoopedId(index);

        var item = _getItemAt(index);

        if (!item || (item.loaded || item.loading) && !_itemsNeedUpdate) {
          return;
        }

        _shout('gettingData', index, item);

        if (!item.src) {
          return;
        }

        _preloadImage(item);
      },
      initController: function initController() {
        framework.extend(_options, _controllerDefaultOptions, true);
        self.items = _items = items;
        _getItemAt = self.getItemAt;
        _getNumItems = _options.getNumItemsFn; //self.getNumItems;

        _initialIsLoop = _options.loop;

        if (_getNumItems() < 3) {
          _options.loop = false; // disable loop if less then 3 items
        }

        _listen('beforeChange', function (diff) {
          var p = _options.preload,
              isNext = diff === null ? true : diff >= 0,
              preloadBefore = Math.min(p[0], _getNumItems()),
              preloadAfter = Math.min(p[1], _getNumItems()),
              i;

          for (i = 1; i <= (isNext ? preloadAfter : preloadBefore); i++) {
            self.lazyLoadItem(_currentItemIndex + i);
          }

          for (i = 1; i <= (isNext ? preloadBefore : preloadAfter); i++) {
            self.lazyLoadItem(_currentItemIndex - i);
          }
        });

        _listen('initialLayout', function () {
          self.currItem.initialLayout = _options.getThumbBoundsFn && _options.getThumbBoundsFn(_currentItemIndex);
        });

        _listen('mainScrollAnimComplete', _appendImagesPool);

        _listen('initialZoomInEnd', _appendImagesPool);

        _listen('destroy', function () {
          var item;

          for (var i = 0; i < _items.length; i++) {
            item = _items[i]; // remove reference to DOM elements, for GC

            if (item.container) {
              item.container = null;
            }

            if (item.placeholder) {
              item.placeholder = null;
            }

            if (item.img) {
              item.img = null;
            }

            if (item.preloader) {
              item.preloader = null;
            }

            if (item.loadError) {
              item.loaded = item.loadError = false;
            }
          }

          _imagesToAppendPool = null;
        });
      },
      getItemAt: function getItemAt(index) {
        if (index >= 0) {
          return _items[index] !== undefined ? _items[index] : false;
        }

        return false;
      },
      allowProgressiveImg: function allowProgressiveImg() {
        // 1. Progressive image loading isn't working on webkit/blink 
        //    when hw-acceleration (e.g. translateZ) is applied to IMG element.
        //    That's why in PhotoSwipe parent element gets zoom transform, not image itself.
        //    
        // 2. Progressive image loading sometimes blinks in webkit/blink when applying animation to parent element.
        //    That's why it's disabled on touch devices (mainly because of swipe transition)
        //    
        // 3. Progressive image loading sometimes doesn't work in IE (up to 11).
        // Don't allow progressive loading on non-large touch devices
        return _options.forceProgressiveLoading || !_likelyTouchDevice || _options.mouseUsed || screen.width > 1200; // 1200 - to eliminate touch devices with large screen (like Chromebook Pixel)
      },
      setContent: function setContent(holder, index) {
        if (_options.loop) {
          index = _getLoopedId(index);
        }

        var prevItem = self.getItemAt(holder.index);

        if (prevItem) {
          prevItem.container = null;
        }

        var item = self.getItemAt(index),
            img;

        if (!item) {
          holder.el.innerHTML = '';
          return;
        } // allow to override data


        _shout('gettingData', index, item);

        holder.index = index;
        holder.item = item; // base container DIV is created only once for each of 3 holders

        var baseDiv = item.container = framework.createEl('pswp__zoom-wrap');

        if (!item.src && item.html) {
          if (item.html.tagName) {
            baseDiv.appendChild(item.html);
          } else {
            baseDiv.innerHTML = item.html;
          }
        }

        _checkForError(item);

        _calculateItemSize(item, _viewportSize);

        if (item.src && !item.loadError && !item.loaded) {
          item.loadComplete = function (item) {
            // gallery closed before image finished loading
            if (!_isOpen) {
              return;
            } // check if holder hasn't changed while image was loading


            if (holder && holder.index === index) {
              if (_checkForError(item, true)) {
                item.loadComplete = item.img = null;

                _calculateItemSize(item, _viewportSize);

                _applyZoomPanToItem(item);

                if (holder.index === _currentItemIndex) {
                  // recalculate dimensions
                  self.updateCurrZoomItem();
                }

                return;
              }

              if (!item.imageAppended) {
                if (_features.transform && (_mainScrollAnimating || _initialZoomRunning)) {
                  _imagesToAppendPool.push({
                    item: item,
                    baseDiv: baseDiv,
                    img: item.img,
                    index: index,
                    holder: holder,
                    clearPlaceholder: true
                  });
                } else {
                  _appendImage(index, item, baseDiv, item.img, _mainScrollAnimating || _initialZoomRunning, true);
                }
              } else {
                // remove preloader & mini-img
                if (!_initialZoomRunning && item.placeholder) {
                  item.placeholder.style.display = 'none';
                  item.placeholder = null;
                }
              }
            }

            item.loadComplete = null;
            item.img = null; // no need to store image element after it's added

            _shout('imageLoadComplete', index, item);
          };

          if (framework.features.transform) {
            var placeholderClassName = 'pswp__img pswp__img--placeholder';
            placeholderClassName += item.msrc ? '' : ' pswp__img--placeholder--blank';
            var placeholder = framework.createEl(placeholderClassName, item.msrc ? 'img' : '');

            if (item.msrc) {
              placeholder.src = item.msrc;
            }

            _setImageSize(item, placeholder);

            baseDiv.appendChild(placeholder);
            item.placeholder = placeholder;
          }

          if (!item.loading) {
            _preloadImage(item);
          }

          if (self.allowProgressiveImg()) {
            // just append image
            if (!_initialContentSet && _features.transform) {
              _imagesToAppendPool.push({
                item: item,
                baseDiv: baseDiv,
                img: item.img,
                index: index,
                holder: holder
              });
            } else {
              _appendImage(index, item, baseDiv, item.img, true, true);
            }
          }
        } else if (item.src && !item.loadError) {
          // image object is created every time, due to bugs of image loading & delay when switching images
          img = framework.createEl('pswp__img', 'img');
          img.style.opacity = 1;
          img.src = item.src;

          _setImageSize(item, img);

          _appendImage(index, item, baseDiv, img, true);
        }

        if (!_initialContentSet && index === _currentItemIndex) {
          _currZoomElementStyle = baseDiv.style;

          _showOrHide(item, img || item.img);
        } else {
          _applyZoomPanToItem(item);
        }

        holder.el.innerHTML = '';
        holder.el.appendChild(baseDiv);
      },
      cleanSlide: function cleanSlide(item) {
        if (item.img) {
          item.img.onload = item.img.onerror = null;
        }

        item.loaded = item.loading = item.img = item.imageAppended = false;
      }
    }
  });
  /*>>items-controller*/

  /*>>tap*/

  /**
   * tap.js:
   *
   * Displatches tap and double-tap events.
   * 
   */


  var tapTimer,
      tapReleasePoint = {},
      _dispatchTapEvent = function _dispatchTapEvent(origEvent, releasePoint, pointerType) {
    var e = document.createEvent('CustomEvent'),
        eDetail = {
      origEvent: origEvent,
      target: origEvent.target,
      releasePoint: releasePoint,
      pointerType: pointerType || 'touch'
    };
    e.initCustomEvent('pswpTap', true, true, eDetail);
    origEvent.target.dispatchEvent(e);
  };

  _registerModule('Tap', {
    publicMethods: {
      initTap: function initTap() {
        _listen('firstTouchStart', self.onTapStart);

        _listen('touchRelease', self.onTapRelease);

        _listen('destroy', function () {
          tapReleasePoint = {};
          tapTimer = null;
        });
      },
      onTapStart: function onTapStart(touchList) {
        if (touchList.length > 1) {
          clearTimeout(tapTimer);
          tapTimer = null;
        }
      },
      onTapRelease: function onTapRelease(e, releasePoint) {
        if (!releasePoint) {
          return;
        }

        if (!_moved && !_isMultitouch && !_numAnimations) {
          var p0 = releasePoint;

          if (tapTimer) {
            clearTimeout(tapTimer);
            tapTimer = null; // Check if taped on the same place

            if (_isNearbyPoints(p0, tapReleasePoint)) {
              _shout('doubleTap', p0);

              return;
            }
          }

          if (releasePoint.type === 'mouse') {
            _dispatchTapEvent(e, releasePoint, 'mouse');

            return;
          }

          var clickedTagName = e.target.tagName.toUpperCase(); // avoid double tap delay on buttons and elements that have class pswp__single-tap

          if (clickedTagName === 'BUTTON' || framework.hasClass(e.target, 'pswp__single-tap')) {
            _dispatchTapEvent(e, releasePoint);

            return;
          }

          _equalizePoints(tapReleasePoint, p0);

          tapTimer = setTimeout(function () {
            _dispatchTapEvent(e, releasePoint);

            tapTimer = null;
          }, 300);
        }
      }
    }
  });
  /*>>tap*/

  /*>>desktop-zoom*/

  /**
   *
   * desktop-zoom.js:
   *
   * - Binds mousewheel event for paning zoomed image.
   * - Manages "dragging", "zoomed-in", "zoom-out" classes.
   *   (which are used for cursors and zoom icon)
   * - Adds toggleDesktopZoom function.
   * 
   */


  var _wheelDelta;

  _registerModule('DesktopZoom', {
    publicMethods: {
      initDesktopZoom: function initDesktopZoom() {
        if (_oldIE) {
          // no zoom for old IE (<=8)
          return;
        }

        if (_likelyTouchDevice) {
          // if detected hardware touch support, we wait until mouse is used,
          // and only then apply desktop-zoom features
          _listen('mouseUsed', function () {
            self.setupDesktopZoom();
          });
        } else {
          self.setupDesktopZoom(true);
        }
      },
      setupDesktopZoom: function setupDesktopZoom(onInit) {
        _wheelDelta = {};
        var events = 'wheel mousewheel DOMMouseScroll';

        _listen('bindEvents', function () {
          framework.bind(template, events, self.handleMouseWheel);
        });

        _listen('unbindEvents', function () {
          if (_wheelDelta) {
            framework.unbind(template, events, self.handleMouseWheel);
          }
        });

        self.mouseZoomedIn = false;

        var hasDraggingClass,
            updateZoomable = function updateZoomable() {
          if (self.mouseZoomedIn) {
            framework.removeClass(template, 'pswp--zoomed-in');
            self.mouseZoomedIn = false;
          }

          if (_currZoomLevel < 1) {
            framework.addClass(template, 'pswp--zoom-allowed');
          } else {
            framework.removeClass(template, 'pswp--zoom-allowed');
          }

          removeDraggingClass();
        },
            removeDraggingClass = function removeDraggingClass() {
          if (hasDraggingClass) {
            framework.removeClass(template, 'pswp--dragging');
            hasDraggingClass = false;
          }
        };

        _listen('resize', updateZoomable);

        _listen('afterChange', updateZoomable);

        _listen('pointerDown', function () {
          if (self.mouseZoomedIn) {
            hasDraggingClass = true;
            framework.addClass(template, 'pswp--dragging');
          }
        });

        _listen('pointerUp', removeDraggingClass);

        if (!onInit) {
          updateZoomable();
        }
      },
      handleMouseWheel: function handleMouseWheel(e) {
        if (_currZoomLevel <= self.currItem.fitRatio) {
          if (_options.modal) {
            if (!_options.closeOnScroll || _numAnimations || _isDragging) {
              e.preventDefault();
            } else if (_transformKey && Math.abs(e.deltaY) > 2) {
              // close PhotoSwipe
              // if browser supports transforms & scroll changed enough
              _closedByScroll = true;
              self.close();
            }
          }

          return true;
        } // allow just one event to fire


        e.stopPropagation(); // https://developer.mozilla.org/en-US/docs/Web/Events/wheel

        _wheelDelta.x = 0;

        if ('deltaX' in e) {
          if (e.deltaMode === 1
          /* DOM_DELTA_LINE */
          ) {
              // 18 - average line height
              _wheelDelta.x = e.deltaX * 18;
              _wheelDelta.y = e.deltaY * 18;
            } else {
            _wheelDelta.x = e.deltaX;
            _wheelDelta.y = e.deltaY;
          }
        } else if ('wheelDelta' in e) {
          if (e.wheelDeltaX) {
            _wheelDelta.x = -0.16 * e.wheelDeltaX;
          }

          if (e.wheelDeltaY) {
            _wheelDelta.y = -0.16 * e.wheelDeltaY;
          } else {
            _wheelDelta.y = -0.16 * e.wheelDelta;
          }
        } else if ('detail' in e) {
          _wheelDelta.y = e.detail;
        } else {
          return;
        }

        _calculatePanBounds(_currZoomLevel, true);

        var newPanX = _panOffset.x - _wheelDelta.x,
            newPanY = _panOffset.y - _wheelDelta.y; // only prevent scrolling in nonmodal mode when not at edges

        if (_options.modal || newPanX <= _currPanBounds.min.x && newPanX >= _currPanBounds.max.x && newPanY <= _currPanBounds.min.y && newPanY >= _currPanBounds.max.y) {
          e.preventDefault();
        } // TODO: use rAF instead of mousewheel?


        self.panTo(newPanX, newPanY);
      },
      toggleDesktopZoom: function toggleDesktopZoom(centerPoint) {
        centerPoint = centerPoint || {
          x: _viewportSize.x / 2 + _offset.x,
          y: _viewportSize.y / 2 + _offset.y
        };

        var doubleTapZoomLevel = _options.getDoubleTapZoom(true, self.currItem);

        var zoomOut = _currZoomLevel === doubleTapZoomLevel;
        self.mouseZoomedIn = !zoomOut;
        self.zoomTo(zoomOut ? self.currItem.initialZoomLevel : doubleTapZoomLevel, centerPoint, 333);
        framework[(!zoomOut ? 'add' : 'remove') + 'Class'](template, 'pswp--zoomed-in');
      }
    }
  });
  /*>>desktop-zoom*/

  /*>>history*/

  /**
   *
   * history.js:
   *
   * - Back button to close gallery.
   * 
   * - Unique URL for each slide: example.com/&pid=1&gid=3
   *   (where PID is picture index, and GID and gallery index)
   *   
   * - Switch URL when slides change.
   * 
   */


  var _historyDefaultOptions = {
    history: true,
    galleryUID: 1
  };

  var _historyUpdateTimeout,
      _hashChangeTimeout,
      _hashAnimCheckTimeout,
      _hashChangedByScript,
      _hashChangedByHistory,
      _hashReseted,
      _initialHash,
      _historyChanged,
      _closedFromURL,
      _urlChangedOnce,
      _windowLoc,
      _supportsPushState,
      _getHash = function _getHash() {
    return _windowLoc.hash.substring(1);
  },
      _cleanHistoryTimeouts = function _cleanHistoryTimeouts() {
    if (_historyUpdateTimeout) {
      clearTimeout(_historyUpdateTimeout);
    }

    if (_hashAnimCheckTimeout) {
      clearTimeout(_hashAnimCheckTimeout);
    }
  },
      // pid - Picture index
  // gid - Gallery index
  _parseItemIndexFromURL = function _parseItemIndexFromURL() {
    var hash = _getHash(),
        params = {};

    if (hash.length < 5) {
      // pid=1
      return params;
    }

    var i,
        vars = hash.split('&');

    for (i = 0; i < vars.length; i++) {
      if (!vars[i]) {
        continue;
      }

      var pair = vars[i].split('=');

      if (pair.length < 2) {
        continue;
      }

      params[pair[0]] = pair[1];
    }

    if (_options.galleryPIDs) {
      // detect custom pid in hash and search for it among the items collection
      var searchfor = params.pid;
      params.pid = 0; // if custom pid cannot be found, fallback to the first item

      for (i = 0; i < _items.length; i++) {
        if (_items[i].pid === searchfor) {
          params.pid = i;
          break;
        }
      }
    } else {
      params.pid = parseInt(params.pid, 10) - 1;
    }

    if (params.pid < 0) {
      params.pid = 0;
    }

    return params;
  },
      _updateHash = function _updateHash() {
    if (_hashAnimCheckTimeout) {
      clearTimeout(_hashAnimCheckTimeout);
    }

    if (_numAnimations || _isDragging) {
      // changing browser URL forces layout/paint in some browsers, which causes noticable lag during animation
      // that's why we update hash only when no animations running
      _hashAnimCheckTimeout = setTimeout(_updateHash, 500);
      return;
    }

    if (_hashChangedByScript) {
      clearTimeout(_hashChangeTimeout);
    } else {
      _hashChangedByScript = true;
    }

    var pid = _currentItemIndex + 1;

    var item = _getItemAt(_currentItemIndex);

    if (item.hasOwnProperty('pid')) {
      // carry forward any custom pid assigned to the item
      pid = item.pid;
    }

    var newHash = _initialHash + '&' + 'gid=' + _options.galleryUID + '&' + 'pid=' + pid;

    if (!_historyChanged) {
      if (_windowLoc.hash.indexOf(newHash) === -1) {
        _urlChangedOnce = true;
      } // first time - add new hisory record, then just replace

    }

    var newURL = _windowLoc.href.split('#')[0] + '#' + newHash;

    if (_supportsPushState) {
      if ('#' + newHash !== window.location.hash) {
        history[_historyChanged ? 'replaceState' : 'pushState']('', document.title, newURL);
      }
    } else {
      if (_historyChanged) {
        _windowLoc.replace(newURL);
      } else {
        _windowLoc.hash = newHash;
      }
    }

    _historyChanged = true;
    _hashChangeTimeout = setTimeout(function () {
      _hashChangedByScript = false;
    }, 60);
  };

  _registerModule('History', {
    publicMethods: {
      initHistory: function initHistory() {
        framework.extend(_options, _historyDefaultOptions, true);

        if (!_options.history) {
          return;
        }

        _windowLoc = window.location;
        _urlChangedOnce = false;
        _closedFromURL = false;
        _historyChanged = false;
        _initialHash = _getHash();
        _supportsPushState = 'pushState' in history;

        if (_initialHash.indexOf('gid=') > -1) {
          _initialHash = _initialHash.split('&gid=')[0];
          _initialHash = _initialHash.split('?gid=')[0];
        }

        _listen('afterChange', self.updateURL);

        _listen('unbindEvents', function () {
          framework.unbind(window, 'hashchange', self.onHashChange);
        });

        var returnToOriginal = function returnToOriginal() {
          _hashReseted = true;

          if (!_closedFromURL) {
            if (_urlChangedOnce) {
              history.back();
            } else {
              if (_initialHash) {
                _windowLoc.hash = _initialHash;
              } else {
                if (_supportsPushState) {
                  // remove hash from url without refreshing it or scrolling to top
                  history.pushState('', document.title, _windowLoc.pathname + _windowLoc.search);
                } else {
                  _windowLoc.hash = '';
                }
              }
            }
          }

          _cleanHistoryTimeouts();
        };

        _listen('unbindEvents', function () {
          if (_closedByScroll) {
            // if PhotoSwipe is closed by scroll, we go "back" before the closing animation starts
            // this is done to keep the scroll position
            returnToOriginal();
          }
        });

        _listen('destroy', function () {
          if (!_hashReseted) {
            returnToOriginal();
          }
        });

        _listen('firstUpdate', function () {
          _currentItemIndex = _parseItemIndexFromURL().pid;
        });

        var index = _initialHash.indexOf('pid=');

        if (index > -1) {
          _initialHash = _initialHash.substring(0, index);

          if (_initialHash.slice(-1) === '&') {
            _initialHash = _initialHash.slice(0, -1);
          }
        }

        setTimeout(function () {
          if (_isOpen) {
            // hasn't destroyed yet
            framework.bind(window, 'hashchange', self.onHashChange);
          }
        }, 40);
      },
      onHashChange: function onHashChange() {
        if (_getHash() === _initialHash) {
          _closedFromURL = true;
          self.close();
          return;
        }

        if (!_hashChangedByScript) {
          _hashChangedByHistory = true;
          self.goTo(_parseItemIndexFromURL().pid);
          _hashChangedByHistory = false;
        }
      },
      updateURL: function updateURL() {
        // Delay the update of URL, to avoid lag during transition, 
        // and to not to trigger actions like "refresh page sound" or "blinking favicon" to often
        _cleanHistoryTimeouts();

        if (_hashChangedByHistory) {
          return;
        }

        if (!_historyChanged) {
          _updateHash(); // first time

        } else {
          _historyUpdateTimeout = setTimeout(_updateHash, 800);
        }
      }
    }
  });
  /*>>history*/


  framework.extend(self, publicMethods);
}
;

/***/ }),

/***/ "./node_modules/custom-event-polyfill/polyfill.js":
/*!********************************************************!*\
  !*** ./node_modules/custom-event-polyfill/polyfill.js ***!
  \********************************************************/
/*! unknown exports (runtime-defined) */
/*! runtime requirements:  */
/***/ (() => {

// Polyfill for creating CustomEvents on IE9/10/11

// code pulled from:
// https://github.com/d4tocchini/customevent-polyfill
// https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent#Polyfill

(function() {
  if (typeof window === 'undefined') {
    return;
  }

  try {
    var ce = new window.CustomEvent('test', { cancelable: true });
    ce.preventDefault();
    if (ce.defaultPrevented !== true) {
      // IE has problems with .preventDefault() on custom events
      // http://stackoverflow.com/questions/23349191
      throw new Error('Could not prevent default');
    }
  } catch (e) {
    var CustomEvent = function(event, params) {
      var evt, origPrevent;
      params = params || {};
      params.bubbles = !!params.bubbles;
      params.cancelable = !!params.cancelable;

      evt = document.createEvent('CustomEvent');
      evt.initCustomEvent(
        event,
        params.bubbles,
        params.cancelable,
        params.detail
      );
      origPrevent = evt.preventDefault;
      evt.preventDefault = function() {
        origPrevent.call(this);
        try {
          Object.defineProperty(this, 'defaultPrevented', {
            get: function() {
              return true;
            }
          });
        } catch (e) {
          this.defaultPrevented = true;
        }
      };
      return evt;
    };

    CustomEvent.prototype = window.Event.prototype;
    window.CustomEvent = CustomEvent; // expose definition to window
  }
})();


/***/ }),

/***/ "./frontend/less/eventgallery.less":
/*!*****************************************!*\
  !*** ./frontend/less/eventgallery.less ***!
  \*****************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./frontend/less/font-awesome/font-awesome.less":
/*!******************************************************!*\
  !*** ./frontend/less/font-awesome/font-awesome.less ***!
  \******************************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./photoswipe/default-skin/default-skin.css":
/*!**************************************************!*\
  !*** ./photoswipe/default-skin/default-skin.css ***!
  \**************************************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./photoswipe/photoswipe.css":
/*!***********************************!*\
  !*** ./photoswipe/photoswipe.css ***!
  \***********************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./frontend/js/Polyfill.ts":
/*!*********************************!*\
  !*** ./frontend/js/Polyfill.ts ***!
  \*********************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
var Polyfill = /** @class */ (function () {
    function Polyfill() {
    }
    Polyfill.removeHtmlElementNode = function (element) {
        if (element.parentNode !== null)
            element.parentNode.removeChild(element);
    };
    Polyfill.createNewEvent = function (eventName, data) {
        var event = null;
        if (typeof (CustomEvent) === 'function') {
            event = new CustomEvent(eventName, { detail: data });
        }
        else {
            event = document.createEvent('Event');
            event.initEvent(eventName, true, true);
            // @ts-ignore
            event.detail = data;
        }
        return event;
    };
    return Polyfill;
}());
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Polyfill);


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => module['default'] :
/******/ 				() => module;
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => Object.prototype.hasOwnProperty.call(obj, prop)
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	// startup
/******/ 	// Load entry module
/******/ 	__webpack_require__("./eventgallery.js");
/******/ 	// This entry module used 'exports' so it can't be inlined
/******/ })()
;
//# sourceMappingURL=eventgallery-debug.js.map