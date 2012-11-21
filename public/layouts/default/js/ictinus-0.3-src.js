/*
 * @include "/js-libs/canvas-doc.js"
 * @include "/ictinus/src/ictinus.js"
 * @include "/ictinus/src/ictinus.drawItems.js"
 * @include "/ictinus/src/ictinus.Shape.js"
 * @include "/ictinus/src/ictinus.Shape.pathData.js"
 */
 
/**
 * Декоратор картинок. Использует Canvas или VML для рисования декораций вокруг
 * картинок, например, уголки причудливой формы. 
 * @author Sergey Chikuyonok (sc@design.ru)
 * @copyright Art.Lebedev Studio (http://www.artlebedev.ru)
 */
var ictinus = (function(){
	var userAgent = navigator.userAgent.toLowerCase();

	/** @type {Boolean} Говорит, что текущий браузер — Internet Explorer */
	var is_msie = /msie/.test( userAgent ) && !/opera/.test( userAgent );
	
	/**
	 * Проверяет, существует ли указанный класс у элемента
	 * @param {HTMLElement} elem
	 * @param {String} className
	 */
	function hasClass(elem, className){
		return elem.nodeType == 1 && elem.className.indexOf(className) != -1;
	}
	
	/**
	 * Адаптер для рисования через canvas
	 */
	function canvasAdapter(){
		/**
		 * Создает холст для рисования для переданного объекта. Элемент холста
		 * будет добавлен <i>перед</i> элементом <code>elem</code>, если элемент
		 * является картинкой (<code>tagName == 'IMG'</code>), либо добавлен 
		 * в сам элемент. Если холст уже был создан, он заново не создается, 
		 * а возвращается ссылка на уже созданный
		 * @param {Element} elem Элемент, для которого нужно создать холст
		 * @return {CanvasRenderingContext2D}
		 */
		function createCanvas(elem){
			/** @type {HTMLCanvasElement} */
			var canvas;
			
			if (elem.className.indexOf('ictinus-init') != -1) {
				// ищем созданный холст
				if (elem.nodeName == 'IMG' && elem.previousSibling.nodeName == 'CANVAS') {
					canvas = elem.previousSibling;
				} else if (elem.getElementsByTagName('canvas').length) {
					canvas = elem.getElementsByTagName('canvas')[0];
				}
			}
			
			if (!canvas) {
				canvas = document.createElement('canvas');
				
				// поправка в 1 пиксель нужна для того, чтобы точнее рисовались нечетные линии
				canvas.width = elem.offsetWidth + 1;
				canvas.height = elem.offsetHeight + 1;
				canvas.className = 'ictinus';
				
				if (elem.tagName == 'IMG') {
					elem.parentNode.insertBefore(canvas, elem);
				} else {
					elem.appendChild(canvas);
				}
				
				elem.className = (elem.className ? elem.className + ' ' : '') + 'ictinus-init';
			}
			return canvas.getContext('2d');
		}
		
		/**
		 * Создает контур на холсте
		 * @param {CanvasRenderingContext2D} ctx
		 * @param {ictinus.Shape} shape
		 */
		function createPath(ctx, shape){
			ctx.beginPath();
			
			shape.traverse(function(/* ictinus.drawItems.Item */ item){
				item.drawCanvas(ctx);
			});
			
			ctx.closePath();
		}
		
		/**
		 * Рисует вспомогательные линии для кривых. Полезен для отладки внешнего
		 * вида формы.
		 * @param {CanvasRenderingContext2D} ctx
		 * @param {ictinus.Shape} shape
		 */
//		function drawHull(ctx, shape){
//			// ставим новые параметры рисования для вспомогательных линий
//			ctx.fillStyle = '#ffcc00';
//			ctx.lineWidth = 1;
//			ctx.strokeStyle = '#00ff00';
//	
//			/**
//			 * Вспомогательный метод для рисования точки
//			 * @param {Number} x 
//			 * @param {Number} y 
//			 * @param {Number} size Размер точки в пикселях
//			 */
//			function drawPoint(x, y, size){
//				ctx.fillRect(x - size / 2 , y - size / 2, size, size);
//			};
//			
//			function drawConnector(from_x, from_y, to_x, to_y){
//				ctx.beginPath();
//				ctx.moveTo(from_x, from_y);
//				ctx.lineTo(to_x, to_y);
//				ctx.stroke();
//				ctx.closePath();
//			}
//
//			var paths = shape.getPaths();
//			ctx.beginPath();
//			
//			shape.traverse(function(/* ictinus.drawItems.Item */ item){
//				ctx.moveTo(item.x, item.y);
//				drawPoint(item.x, item.y, 6);
//				
//				if (item.typeOf('bezier')) {
//					drawConnector(item.x, item.y, item.cpx2, item.cpy2);
//					drawConnector(item.prev().x, item.prev().y, item.cpx1, item.cpy1);
//					drawPoint(item.cpx1, item.cpy1, 2);
//					drawPoint(item.cpx2, item.cpy2, 2);
//					
//					ctx.moveTo(item.x, item.y);
//				}
//			});
//		};
		
		/**
		 * Готовит холст для рисования: меняет ему размеры под габариты формы, 
		 * ставит указатель рисования в нужную точку и т.д.
		 * @param {CanvasRenderingContext2D} ctx
		 * @param {ictinus.drawItems.Item} shape
		 */
		function prepareCanvas(ctx, shape) {
			ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
			
			// меняем размеры холста
			ctx.canvas.width = Math.ceil(shape.width() + shape.paddingLeft + shape.paddingRight + shape.strokeWidth * 2);
			ctx.canvas.height = Math.ceil(shape.height() + shape.paddingTop + shape.paddingBottom + shape.strokeWidth * 2);
			
			ctx.save();
			var offset = Math.floor(shape.strokeWidth / 2);
			ctx.translate(shape.paddingLeft + offset, shape.paddingTop + offset);
		}
		
		return {
			/**
			 * Рисует декорации для картинки
			 * @param {Element} img Картинка, для которой нужно нарисовать декорации
			 * @param {ictinus.Shape} shape Форма декорации (массив, состоящий из объектов типа line())
			 */
			decorate: function(img, shape){
				var ctx = createCanvas(img);
				
				// FIXME это быстрый хак, чтобы рисовались линии нечетной толщины, придумать более надежный механизм
				var offset = (shape.strokeWidth % 2) / 2;
				
				prepareCanvas(ctx, shape);
				
				// сначала рисую форму декорации, которая будет служить контуром отсечения
				ctx.save();
				
				createPath(ctx, shape);
				ctx.clip();
				
				if (shape.fillColor) {
					ctx.rect(0, 0, img.offsetWidth, img.offsetHeight);
					ctx.fillStyle = shape.fillColor;
					ctx.fill();
				}
				
				ctx.translate(shape.contentBox.x, shape.contentBox.y);
//				alert('draw');
				ctx.drawImage(img, 0, 0, img.offsetWidth, img.offsetHeight);
				ctx.restore();
				
				
				if (shape.strokeWidth) {
					// еще раз создам контур, чтобы нормально отработал stroke в Сафари
					ctx.save();
					// делаю небольшую поправку для координат, чтобы 
					// прямые линии не были смазанными
					ctx.translate(offset, offset);
					
					createPath(ctx, shape);
					ctx.strokeStyle = shape.strokeColor;
					ctx.lineWidth = shape.strokeWidth;
					ctx.stroke();
					ctx.restore();
				}
				ctx.restore();
				
//				drawHull(ctx, shape);
			},
			
			/**
			 * Рисует форму
			 * @param {Element} target Элемент, в который нужно добавить холст
			 * @param {ictinus.Shape} shape Форма, которую нужно нарисовать
			 */
			draw: function(target, shape){
				var ctx = createCanvas(target);
				
				prepareCanvas(ctx, shape);
				
				createPath(ctx, shape);
				ctx.fillStyle = shape.fillColor;
				ctx.fill();
				
				if (shape.strokeWidth) {
					ctx.strokeStyle = shape.strokeColor;
					ctx.lineWidth = shape.strokeWidth;
					ctx.stroke();
				}
				
				ctx.restore();
			}
		}
	};
	
	/**
	 * Адаптер для рисования через VML
	 */
	function vmlAdapter(){
		/** Повышающий коэффициент для координатного пространства */
		var multiplier = 10;
		
		// XXX разобраться, почему тут стояло значение 1
		// FIXME разобрался — влияет толщина обводки, доделать
		var offset = 0;
		
		/**
		 * Исправляет форму рисования.
		 * Похоже, что VML в IE не поддерживает дробные коэффициенты,
		 * потому что сейчас они кардинально меняют отрисованную форму.
		 * Этот метод умнажает каждую координату формы рисования на 
		 * <code>multiplier</code> и округляет ее, тем самым избавляет линии
		 * от дробных коэффициентов.
		 * Надо помнить, что просле применения этого метода нужно в том числе
		 * изменить координатное пространство элемента shape, умножив его 
		 * габариты на <code>multiplier</code>
		 * @param {ictinus.Shape} shape Форма рисования
		 * @param {Array} Новый набор инструкций для рисования
		 */
		function getFixedPaths(shape){
			// из shape.getPaths() к нам могут прийти сессионные пути — это
			// будет именно ссылка на объект, который нам ни в коем случае менять 
			// нельзя, поэтому делаю дубликаты
			var new_paths = [];
			
			shape.traverse(function(/* ictinus.drawItems.Item */ item){
				var clone = item.clone();
				
				// не забываем проставлять ссылки на следующий/предыдущмй элементы
				if (new_paths.length) {
					new_paths[new_paths.length - 1].next(clone);
					clone.prev(new_paths[new_paths.length - 1]);
				}
				
				clone.walkOnCoords(function(prop){
					this[prop] = Math.round(this[prop] * multiplier);
				});
				new_paths.push(clone);
			}, shape.getPaths());
			
			return new_paths;
		}
		
		if (!document.namespaces["v"]) {
			document.namespaces.add("v", "urn:schemas-microsoft-com:vml");
			// setup default css
			var ss = document.createStyleSheet();
			ss.cssText = "v\\:* {behavior:url(#default#VML);display:block;}";
		}
		
		/**
		 * Создает строку, описывающую путь в формате path data
		 * @param {ictinus.Shape} shape
		 * @return {String}
		 */
		function createPathString(shape){
			var path = [];
			shape.traverse(function(/* ictinus.drawItems.Item */ item){
				path.push(item.drawVML());
			}, getFixedPaths(shape));
			
			path.push('x e');
			
			return path.join(' ');
		}
		
		/**
		 * Создает импровизированный холст для рисования для переданного объекта. 
		 * Холст представляет собой элемент div с классом ictinus
		 * Элемент холста будет добавлен <i>перед</i> элементом <code>elem</code>
		 * @param {Element} elem Элемент, для которого нужно создать холст
		 * @return {HTMLElement}
		 */
		function createCanvas(elem){
			/** @type {HTMLElement} */
			var canvas;
			
			if (elem.className.indexOf('ictinus-init') != -1) {
				// ищем созданный холст
				if (elem.nodeName == 'IMG' && hasClass(elem.previousSibling, 'ictinus')) {
					canvas = elem.previousSibling;
				} else if (elem.getElementsByTagName('div').length) {
					var children = elem.getElementsByTagName('div');
					for (var i = 0; i < children.length; i++) {
						if (hasClass(children[i], 'ictinus')) {
							canvas = children[i];
							break;
						}
					}
				}
			}
			
			if (!canvas) {
				canvas = document.createElement('div');
				
				canvas.style.width = elem.offsetWidth + 'px';
				canvas.style.height = elem.offsetHeight + 'px';
				canvas.className = 'ictinus';
				
				if (elem.tagName == 'IMG') {
					elem.parentNode.insertBefore(canvas, elem);
				} else {
					elem.appendChild(canvas);
				}
				
				elem.className = (elem.className ? elem.className + ' ' : '') + 'ictinus-init';
			}
			return canvas;
		}
		
		return {
			/**
			 * Рисует декорации для картинки
			 * @param {Element} img Картинка, для которой нужно нарисовать декорации
			 * @param {ictinus.Shape} shape Форма декорации
			 * @param {Object} params Параметры декорации: цвет (line_color) и толщина (line_width) линии
			 */
			decorate: function(img, shape){
				
				/** @type {Element} */
				var fill;
				
				this.draw(img, shape);
				
				/** @type {HTMLElement} */
				var elem = shape._cache.shape_elem
				
				var cached = Boolean(shape._cache.fill_elem);
				
				if (cached) {
					fill = shape._cache.fill_elem;
				} else {
					// создаю заливку формы				
					fill = document.createElement('v:fill');
					fill.type = 'tile';
					elem.appendChild(fill);
					shape._cache.fill_elem = fill;
				}
				
				/*
				 * очень важно, чтобы координаты определялись до того, как будет
				 * присвоен src элементу, иначе IE будет периодически тупить
				 * и возвращать неправильные значения
				 */
				fill.origin = ((elem.offsetLeft + offset - shape.paddingLeft) / img.offsetWidth) + ' ' + ((elem.offsetTop + offset - shape.paddingTop) / img.offsetHeight);
				fill.size = img.width + 'px,' + img.height + 'px';
				fill.src = img.src;
			},
			
			/**
			 * Рисует форму
			 * @param {Element} target Элемент, в который нужно добавить холст
			 * @param {ictinus.Shape} shape Форма, которую нужно нарисовать
			 */
			draw: function(target, shape){
				// TODO добавить поддержку полупрозрачности в fillColor
				
				/** @type {Element} */
				var elem;
				
				/** @type {HTMLElement} */
				var cv;
				
				var cached = Boolean(shape._cache.shape_elem);
				
				if (cached) {
					elem = shape._cache.shape_elem;
				} else {
					// создаю элемент контура
					elem = document.createElement('v:shape');
					cv = createCanvas(target);
					shape._cache.shape_elem = elem;
				}
				
				if (!shape.strokeWidth) {
					elem.stroked = false;
				} else {
					elem.strokeweight = shape.strokeWidth;
					elem.strokecolor = shape.strokeColor;
				}
				
				elem.fillcolor = shape.fillColor;
				
				
				var w = shape.width() + shape.paddingLeft + shape.paddingRight;
				var h = shape.height() + shape.paddingTop + shape.paddingBottom;
				
				elem.style.width = w + 'px';
				elem.style.height = h + 'px';
				elem.coordorigin = (-shape.paddingLeft * multiplier) + ' ' + (-shape.paddingTop * multiplier);
				elem.coordsize = (w * multiplier + offset) + ' ' + (h * multiplier + offset);
				
				
				elem.path = createPathString(shape);
				
				if (!cached) {
					cv.appendChild(elem);
				}
			}
		}

	};
	
	var painter = is_msie ? vmlAdapter() : canvasAdapter();
	
	return {
		/**
		 * Рисует декорации для картинки
		 * @param {Element} img Картинка, для которой нужно нарисовать декорации
		 * @param {ictinus.Shape} shape Форма рисования
		 */
		decorate: function(img, shape){
			painter.decorate(img, shape);
		},
		
		/**
		 * Рисует форму <code>shape</code> внутри элемента
		 * @param {Element} target Контейнер, в котором нужно рисовать
		 * @param {ictinus.Shape} shape Форма, которую нужно нарисовать
		 */
		draw: function(target, shape){
			painter.draw(target, shape);
		}
	};
})();/**
 * Элементы рисования для иктинуса.
 * 
 * @author Sergey Chikuyonok (serge.che@gmail.com)
 * @copyright Art.Lebedev Studio (http://www.artlebedev.ru)
 * @include "/ictinus/src/ictinus.js"
 */

ictinus.drawItems = (function() {

	/**
	 * Простой механизм наследования классов
	 * 
	 * @param {Function}
	 *            derived Наследуемый класс
	 * @param {Function}
	 *            from Базовый класс
	 */
	function inherit(derived, from) {
		var Inheritance = function() {
		};

		Inheritance.prototype = from.prototype;

		derived.prototype = new Inheritance();
		derived.prototype.constructor = derived;
		derived.baseConstructor = from;
		derived.superClass = from.prototype;
	};
	
	/**
	 * Обрезает число до 3 знаков после запятой
	 * @param {Number} num
	 */
	function crop(num) {
		return Math.round(num * 1000) / 1000;
	}
	
	/**
	 * Бегает по всем X и Y координатам объекта <code>item</code> и выполняет 
	 * на каждой координате функцию <code>func</code>, в которую передается 2 аргумента:
	 * <code>property</code> : String — название свойства, <code>type</code> : String — 
	 * тип свойства (x или y)
	 * @param {IcDrawItem} item
	 * @param {String|Array} x Массив X-координат объекта
	 * @param {String|Array} y Массив Y-координат объекта
	 * @param {Function} func Функция, выполняемая на каждом свойстве (<code>this</code> указывает на <code>item</code>). 
	 */
	function walkOnCoords(item, x, y, func) {
		x = (typeof(x) == 'string') ? x.split(',') : x;
		y = (typeof(y) == 'string') ? y.split(',') : y;
		
		for (var i = 0; i < x.length; i++) {
			func.call(item, x[i], 'x');
		}
		
		for (var i = 0; i < y.length; i++) {
			func.call(item, y[i], 'y');
		}
	}
	
	/**
	 * Расширяет объект <code>obj</code> с помощью свойств объекта <code>extender</code>
	 * @param {Object} obj
	 * @param {Object} extender
	 */
	function extend(obj, extender) {
		if (obj && extender)
			for (var p in extender) {
				obj[p] = extender[p];
				
			}
	}
	
	/** Ошибки, которые могут возникать при работе с элементами рисования */
	var errors = {
		no_prev: 'Этот элемент рисования не может быть первым в списке'
	};
	
	function throwError(type) {
		throw new Error(errors[type]);
	}

	/**
	 * @class Абстрактный элемент рисования
	 */
	function IcDrawItem() {
		/** @private */
		this._next = null;
		/** @private */
		this._prev = null;
	}

	IcDrawItem.prototype = {
		/**
		 * Преобразование элемента рисования к строке. Используется для экспорта
		 * в JSON
		 * 
		 * @return {String}
		 */
		toString : function() {
			return '';
		},

		/**
		 * Возвращает габаритный прямоугольник элемента рисования
		 */
		getBounds : function() {
			return {
				minX : 0,
				minY : 0,
				maxX : 0,
				maxY : 0
			};
		},

		/**
		 * Возвращает или устанавливает следующий элемент рисования
		 * 
		 * @param {IcDrawItem}
		 *            [item] Следующий элемент рисования в форме
		 * @return {ictinus.drawItems.Item}
		 */
		next : function(item) {
			if (arguments.length)
				this._next = item;

			return this._next || null;
		},

		/**
		 * Возвращает или устанавливает предыдущий элемент рисования
		 * 
		 * @param {IcDrawItem}
		 *            [item] Предыдущий элемент рисования в форме
		 * @return {ictinus.drawItems.Item}
		 */
		prev : function(item) {
			if (arguments.length)
				this._prev = item;

			return this._prev || null;
		},

		/**
		 * Клонирует текущий объект
		 * 
		 * @return {ictinus.drawItems.Item}
		 */
		clone : function() {
			return new this.constructor();
		},
		
		/**
		 * Проверяет, является ли текущий объект типом рисования <code>type</code>
		 * ('move', 'line', 'bezier')
		 * @param {String} Тип рисования
		 * @return {Boolean}
		 */
		typeOf: function(type){
			switch(type) {
				case 'move':
					return this.constructor == IcMove;
				case 'line':
					return this.constructor == IcLine;
				case 'bezier':
					return this.constructor == IcBezier;
			}
			
			return false;
		},
		
		/**
		 * Бегает по всем X и Y координатам объекта <code>item</code> и выполняет 
		 * на каждой координате функцию <code>func</code>, в которую передается 2 аргумента:
		 * <code>property</code> : String — название свойства, <code>type</code> : String — 
		 * тип свойства (x или y)
		 * @param {Function} func Функция, выполняемая на каждом свойстве (<code>this</code> указывает на <code>item</code>). 
		 */
		walkOnCoords: function(){
			
		},
		
		/**
		 * Рисует текущий путь на холсте (canvas)
		 * @param {CanvasRenderingContext2D} ctx
		 */
		drawCanvas: function(ctx){
			
		},
		
		/**
		 * Рисует текущий путь как VML
		 * @return {String}
		 */
		drawVML: function(){
//			alert(this.toString().toLowerCase());
			return this.toString().toLowerCase();
		}
	}

	/**
	 * Переместиться в указанную точку
	 * 
	 * @extends {IcDrawItem}
	 * @param {Number}
	 *            x
	 * @param {Number}
	 *            y
	 */
	function IcMove(x, y) {
		IcMove.baseConstructor.call(this);
		this.x = x;
		this.y = y;
	}
	
	inherit(IcMove, IcDrawItem);
	
	extend(IcMove.prototype, {
		clone : function() {
			return new this.constructor(this.x, this.y);
		},
		
		walkOnCoords: function(func){
			walkOnCoords(this, 'x', 'y', func);
		},
		
		drawCanvas: function(ctx){
			ctx.moveTo(this.x, this.y);
		}
	});
	
	// IE, гад, не хочет просто так получать функцию toString в extend()
	IcMove.prototype.toString = function() {
		return 'M' + crop(this.x) + ',' + crop(this.y);
	}
	
	/**
	 * Нарисовать линию в указанную точку
	 * 
	 * @extends {IcMove}
	 * @param {Number}
	 *            x
	 * @param {Number}
	 *            y
	 */
	function IcLine(x, y) {
		IcLine.baseConstructor.call(this);
		this.x = x;
		this.y = y;
	}
	
	inherit(IcLine, IcMove);
	
	extend(IcLine.prototype, {
		getBounds : function() {
			if (!this.prev())
				throwError(errors.no_prev);

			return {
				minX : Math.min(this.prev().x, this.x),
				minY : Math.min(this.prev().y, this.y),
				maxX : Math.max(this.prev().x, this.x),
				maxY : Math.max(this.prev().y, this.y)
			};
		},
		
		drawCanvas: function(ctx){
			ctx.lineTo(this.x, this.y);
		}
	});
	
	IcLine.prototype.toString = function() {
		return 'L' + crop(this.x) + ',' + crop(this.y);
	}
	

	/**
	 * Нарисовать кривую Безье в указанную точку
	 * 
	 * @class
	 * @extends {IcDrawItem}
	 * @param {Number}
	 *            x
	 * @param {Number}
	 *            y
	 * @param {Number}
	 *            cpx1
	 * @param {Number}
	 *            cpy1
	 * @param {Number}
	 *            cpx2
	 * @param {Number}
	 *            cpy2
	 * @param {Boolean}
	 *            locked
	 */
	function IcBezier(x, y, cpx1, cpy1, cpx2, cpy2, locked) {
		IcBezier.baseConstructor.call(this);
		this.x = x;
		this.y = y;
		this.cpx1 = cpx1;
		this.cpy1 = cpy1;
		this.cpx2 = cpx2;
		this.cpy2 = cpy2;
		this.locked = locked || false;
	}
	
	inherit(IcBezier, IcDrawItem);
	
	extend(IcBezier.prototype, {
		clone : function() {
			return new this.constructor(this.x, this.y, this.cpx1, this.cpy1,
					this.cpx2, this.cpy2, this.locked);
		},
		
		walkOnCoords: function(func){
			walkOnCoords(this, 'x,cpx1,cpx2', 'y,cpy1,cpy2', func);
		},

		getBounds : function() {
			
			/**
			 * @class
			 * Точка
			 * @param {Number} x
			 * @param {Number} y
			 */
			function Point(x, y) {
				/** @type {Number} */
				this.x = x;
				/** @type {Number} */
				this.y = y;
			}

			var solutions = [];

			/**
			 * Квадратное уравнение с отсечением решений вне (0,1)
			 * 
			 * @author Олег Коротаев (korotaev@design.ru)
			 * @param {Number} a
			 * @param {Number} b
			 * @param {Number} c
			 */
			function solveSq(a, b, c) {
				var g = b * b - 4 * a * c;

				if (a == 0) {
					solutions.push(-c / b);
					return;
				}

				if (g == 0) {
					solutions.push(-b / (2 * a));
				} else if (g > 0) {
					var d = Math.sqrt(b * b - 4 * a * c);

					if ((-b + d) / (2 * a) < 1 && (-b + d) / (2 * a) > 0)
						solutions.push((-b + d) / (2 * a));

					if ((-b - d) / (2 * a) < 1 && (-b - d) / (2 * a) > 0)
						solutions.push((-b - d) / (2 * a));
				}
			}

			/**
			 * Уравнение кривой Безье
			 * 
			 * @param {Number}
			 *            p0 Начальная точка
			 * @param {Number}
			 *            p1 Первая контрольная точка
			 * @param {Number}
			 *            p2 Вторая контрольная точка
			 * @param {Number}
			 *            p3 Конечная точка
			 * @param {Number}
			 *            t Time-итератор
			 * @return {Number} Координата для текущего time-итератора (<code>t</code>)
			 *         и точек
			 */
			function bezier(p0, p1, p2, p3, t) {
				return Math.pow(1 - t, 3) * p0 + 3 * t * Math.pow(1 - t, 2) * p1 + 3 * t * t * (1 - t) * p2 + t * t * t * p3;
			}

			return function() {
				
				if (!this.prev())
					throwError(errors.no_prev);
				
				var p0 = new Point(this.prev().x, this.prev().y);
				var p1 = new Point(this.cpx1, this.cpy1);
				var p2 = new Point(this.cpx2, this.cpy2);
				var p3 = new Point(this.x, this.y);
				 
				solutions = [];
				solutions.push(0); // начало кривой
				solutions.push(1); // конец кривой
				
				// производная кривой
				solveSq(
					-3 * p0.x + 9 * p1.x - 9 * p2.x + 3 * p3.x, 
					 6 * p0.x - 12 * p1.x + 6 * p2.x,
					-3 * p0.x + 3 * p1.x
				); 

				solveSq(
					-3 * p0.y + 9 * p1.y - 9 * p2.y + 3 * p3.y,
					 6 * p0.y - 12 * p1.y + 6 * p2.y,
					-3 * p0.y + 3 * p1.y
				);

				var maxx = -1, maxy = -1, minx = 1000, miny = 1000;

				for (var i = 0; i < solutions.length; i++) {
					var result;
					if (minx > (result = bezier(p0.x, p1.x, p2.x, p3.x, solutions[i])))
						minx = result;

					if (miny > (result = bezier(p0.y, p1.y, p2.y, p3.y, solutions[i])))
						miny = result;

					if (maxx < (result = bezier(p0.x, p1.x, p2.x, p3.x, solutions[i])))
						maxx = result;

					if (maxy < (result = bezier(p0.y, p1.y, p2.y, p3.y, solutions[i])))
						maxy = result;
				}

				return {
					minX : minx,
					minY : miny,
					maxX : maxx,
					maxY : maxy
				};
			}
		}(),
		
		drawCanvas: function(ctx){
			ctx.bezierCurveTo(this.cpx1, this.cpy1, this.cpx2, this.cpy2, this.x, this.y);
		},
		
		drawVML: function(){
			return this.toString().toLowerCase().replace('o', 'c');
		}
	});
	
	IcBezier.prototype.toString = function() {
		return (this.locked ? 'O' : 'C') + 
			crop(this.cpx1) + ',' + crop(this.cpy1) + ',' + 
			crop(this.cpx2) + ',' + crop(this.cpy2) + ',' + 
			crop(this.x) + ',' + crop(this.y);
	};

	return {
		Item: IcDrawItem,
		MoveTo: IcMove,
		LineTo: IcLine,
		BezierTo: IcBezier
	};

})();/**
 * Класс, содержащий описание формы для рисования.
 * 
 * @param {Array, String} [paths] Пути, описывающие контур (см. {@link ictinus.drawItems.Item}). Это может быть либо массив путей, либо строка в формате SVG path data {@link http://www.w3.org/TR/SVG/paths.html#PathData}
 * @author Sergey Chikuyonok (sc@design.ru)
 * @copyright Art.Lebedev Studio (http://www.artlebedev.ru)
 * 
 * @include "/ictinus/src/ictinus.js"
 * @include "/ictinus/src/ictinus.drawItems.js"
 * @include "/ictinus/src/ictinus.Shape.js"
 * @include "/ictinus/src/ictinus.Shape.pathData.js"
 */
ictinus.Shape = function(paths){
	/** 
	 * Кэш, устанавливаемый иктинусом, для ускорения перерисовки
	 * @private 
	 */
	this._cache = {};
	
	/** 
	 * Сессионные параметры,устанавливаемые на время рисования формы
	 * @private 
	 */
	this._session = {};
	
	if (typeof(paths) == 'string') {
		paths = ictinus.Shape.pathData.parse(paths);
	}
	
	/** 
	 * Векторные пути, описывающие форму
	 * @private 
	 */
	this.paths = paths || [];
	
	/** Толщина обводки, в пикселях */
	this.strokeWidth = 0;
	
	/** 
	 * Цвет обводки в шестнадцатеричном формате
	 * @example
	 * #00ffcc 
	 */
	this.strokeColor = '#000000';
	
	/** 
	 * Цвет заливки в шестнадцатеричном формате
	 * @example
	 * #00ffcc
	 */
	this.fillColor = '';
	
	/** Цвет обводки в шестнадцатеричном формате
	 * @example
	 * #ff0000
	 * /
	this.fillColor = '';
	
	/** Сетка масшатбирования (аналог 9-grid scale из Adobe Flash) */
	this.scaleGrid = {
		x1: 0,
		x2: 0,
		y1: 0,
		y2: 0
	};
	
	// отступы
	this.paddingLeft = 0;
	this.paddingRight = 0;
	this.paddingTop = 0;
	this.paddingBottom = 0;
	
	/** 
	 * Область, в которой находится контент. Используется внешними механизмами
	 * для определения масштабирования (scaleX и scaleY) формы под новый 
	 * контент, а также для позиционирования контента относительно формы.<br>
	 * <b>В стадии разработки, пользоваться крайне нежелательно!</b>
	 */
	this.contentBox = {
		x: 0,
		y: 0,
		width: 0,
		height: 0
	};
	
	/** @private */
	this._scaleX = 1;
	/** @private */
	this._scaleY = 1;
}

/**
 * Рассчитывает координаты второй контрольной точки
 * для обеспечения сохранности касательной между двумя кривыми Безье. 
 * В качестве первой пары аргументов указывается точка, 
 * <i>относительно</i> которой нужно считать координаты, в качестве второй —
 * точка, <i>для</i> которой нужно считать координаты, третья пара — 
 * концевая точка, которой принадлежат обе контрольные точки 
 * @param {Number} cp1_x
 * @param {Number} cp1_y
 * @param {Number} cp2_x
 * @param {Number} cp2_y
 * @param {Number} anchor_x
 * @param {Number} anchor_y
 */
ictinus.Shape.calculateTangentPoint = function(cp1_x, cp1_y, cp2_x, cp2_y, anchor_x, anchor_y){
	var a = Math.atan2(cp1_y - anchor_y, cp1_x - anchor_x);
	var b = (a + Math.PI) % (Math.PI * 2);

	var catet_x = cp2_x - anchor_x;
	var catet_y = cp2_y - anchor_y;

	var hypot = Math.sqrt(catet_x * catet_x + catet_y * catet_y);

	return {x: Math.cos(b) * hypot + anchor_x, y: Math.sin(b) * hypot + anchor_y};
};

/**
 * Создает форму из JSON-объекта
 * @param {Object} obj
 * @return {ictinus.Shape}
 */
ictinus.Shape.fromJSON = function(obj){
	/** @return {Array} */
	function explode(str) {
		return (str || '').replace(/^\s+|\s+$/g, '').replace(/\s+/, ' ').split(' ');
	}
	
	var result = new ictinus.Shape(obj.paths);
	result.scaleX(obj.scaleX);
	result.scaleY(obj.scaleY);
	
	var props = 'strokeWidth,strokeColor,fillColor'.split(',');
	for (var i = 0; i < props.length; i++) 
		if (obj.hasOwnProperty(props[i])) 
			result[props[i]] = obj[props[i]];
	
	result.padding(obj.padding);
	
	var sg = explode(obj.scaleGrid);
	if (sg.length == 4) {
		result.scaleGrid.x1 = sg[0];
		result.scaleGrid.x2 = sg[1];
		result.scaleGrid.y1 = sg[2];
		result.scaleGrid.y2 = sg[3];
	}
	
	var cb = explode(obj.contentBox);
	if (cb.length == 4) {
		result.contentBox.x = cb[0];
		result.contentBox.y = cb[1];
		result.contentBox.width = cb[2];
		result.contentBox.height = cb[3];
	}
	
	return result;
};

ictinus.Shape.prototype = {
	/**
	 * Исправляет касательные в кривых Безье там, где это надо
	 * @param {Array} paths
	 */
	fixTangents: function(paths){
		if (!paths)
			throw new Error('No paths specified');
			
		var orig_first, orig_last, real_first, real_last;
		
		// находим начальную и конечную инструкцию у оригинала
		this.traverse(function(/* ictinus.drawItems.Item */ item){
			if (!item.prev())
				orig_first = item;
			else if (!item.next())
				orig_last = item;
		}, this.paths);
		
		// бегаем по переданным путям
		this.traverse(function(/* ictinus.drawItems.Item */ item, paths){
			if (!item.prev())
				real_first = item;
			else if (!item.next())
				real_last = item;
			
			if (
				item.typeOf('bezier') && 
				item.locked &&
				item.prev().typeOf('bezier')
			) {
				var prev_item = item.prev();
				var tan = ictinus.Shape.calculateTangentPoint(prev_item.cpx2, prev_item.cpy2, item.cpx1, item.cpy1, prev_item.x, prev_item.y);
				item.cpx1 = tan.x;
				item.cpy1 = tan.y;
			}
		}, paths);
		
		// если у оригинала совпадают начальные и конечные точки — зафиксируем их
		// для текущих путей
		if (orig_first.x == orig_last.x && orig_first.y == orig_last.y) {
			real_last.x = real_first.x; 
			real_last.y = real_first.y; 
		}
		
		return paths;
		
	},
	
	/**
	 * Бегает по всем инструкциям рисования в том порядке, в котором они должны
	 * быть нарисованы, и выполняет на каждой функцию <code>func</code>
	 * @param {Function} func Функция, выполняемая на каждой инструкции рисования (в качестве аргументов ей передается текущая инструкция рисования и значение итератора)
	 * @param {ictinus.drawTypes.Item[]} [paths] Набор инструкций рисования, по которым нужно бегать (по умолчанию бегаем по <code>this.paths</code>)
	 * @param {Function} [sort] Функция сортировки, которая определяет, в какой последовательности нужно перебирать элементы (аналог <code>Array.prototype.sort</code>)
	 */
	traverse: function(func, paths, sort){
		paths = paths || this.getPaths();
		
		if (sort) {
			var ar = paths.slice(0).sort(sort);
			for (var i = 0; i < ar.length; i++) {
				func(ar[i], i);
			}
			
		} else {
			// находим точку старта
			for (var i = 0; i < paths.length; i++) {
				if (paths[i] instanceof ictinus.drawItems.MoveTo) {
					var start = paths[i];
					var j = 0;
					do {
						func(start, j++);
					} while(start = start.next())
					
					break;
				}
			}
		}
		
	},
	
	/**
	 * Возвращает пути, описывающие форму. Важно помнить, что это не ссылка на
	 * private-свойство <code>this.paths</code>, а именно новый массив путей,
	 * которые были пересчитаны с учетом масштаба и сетки масштабирования
	 * @param {Boolean} [no_session] Нужно ли отдавать сессионные пути, если они есть?  
	 * @return {Array}
	 */
	getPaths: function(no_session){
		
		if (this._session.paths && !no_session) {
			/*
			 * В метода draw() отдали другие пути — вернем их
			 */
			return this.fixTangents(this._session.paths);
		}
		
		var result = [];
		
		var props = {
			x: ['x', 'cpx', 'cpx1', 'cpx2'],
			y: ['y', 'cpy', 'cpy1', 'cpy2']
		};
		
		/**
		 * Выполняет на каждом элементе объекта <code>obj</code> функцию 
		 * <code>func</code> и присваивает элементу объекта результат работы 
		 * функции
		 * @param {Object} obj
		 * @param {Function} func
		 * @param {String} token Для какого типа свойств (<b>x</b> или <b>y</b>) нужно выполнить маппинг
		 */
		function map(obj, func, token) {
			for (var i = 0; i < props[token].length; i++) {
				var p = props[token][i];
				if (obj.hasOwnProperty(p)) 
					obj[p] = func(obj[p]);
			}
		}
		
		var sx = this.scaleX();
		var sy = this.scaleY();
		
		// считаем, на сколько изменились габариты формы и сетки
		var bounds = this.getBounds(true);
		var dw = (bounds.maxX - bounds.minX) * (sx - 1);
		var dh = (bounds.maxY - bounds.minY) * (sy - 1);
		
		var mapFunc = {
			moveX: function(value){
				return value + dw;
			},
			
			moveY: function(value){
				return value + dh;
			},
			
			scaleX: function(value){
				return value * sx;
			},
			
			scaleY: function(value){
				return value * sy;
			}
		};
		
		if (!this.isEmptyGrid()) {
			// сетка масштабирования не пустая — считаем пути согласно ей
			
			// FIXME сам по себе метод работает не совсем правильно: не корректно масштабируются кривые Безье, если контрольне точки находятся в другой ячейке
			
			/*
			 * Сетка масштабирования по сути представляет собой матрицу 3х3, для
			 * каждой ячейки которой соответствует свой способ масштабирования:
			 * — для 11, 13, 31, 33 масштабирование не применяется
			 * — для 12, 32 масштабирование по горизонтали
			 * — для 21, 23 масштабирование по вертикали
			 * — для 22 масштабирование по горизонтали и вертикали
			 * 
			 * Алгоритм выглядит так: сначала все компоненты рисования 
			 * (ictinus.drawTypes) виртуально распихаем по этим ячейкам, затем 
			 * масштабировуем все координаты в нужных ячейках
			 */
			
			var grid = this.scaleGrid;
			
			/**
			 * Возвращает ячейку сетки масштабирования (11, 31, 22 и т.д.), 
			 * в которой находится точка с указанными координатами
			 * @param {Number} x
			 * @param {Number} y
			 * @return {Number}
			 */
			function getCell(x, y) {
				var row, col;
				
				if (x <= grid.x1)
					col = 1;
				else if (x >= grid.x2)
					col = 3;
				else
					col = 2;
				
				if (y <= grid.y1)
					row = 10;
				else if (y >= grid.y2)
					row = 30;
				else
					row = 20;
				return row + col;
			}
			
			this.traverse(function(/* ictinus.drawItems.Item */ item){
				var p = item.clone();
				
				// не забываем проставлять ссылки на предыдущий/следующий элемент
				if (result.length) {
					p.prev(result[result.length - 1]);
					result[result.length - 1].next(p);
				}
				
				var cell;
				
				for (var j = 0; j < props.x.length; j++) {
					var px =  props.x[j], py = props.y[j];
					
					if (p.hasOwnProperty(px) && p.hasOwnProperty(py)) {
						switch (getCell(p[px], p[py])) {
							case 12:
								p[px] = mapFunc.scaleX(p[px]);
								break;
							case 13:
								p[px] = mapFunc.moveX(p[px]);
								break;
							case 21:
								p[py] = mapFunc.scaleY(p[py]);
								break;
							case 22:
								p[px] = mapFunc.scaleX(p[px]);
								p[py] = mapFunc.scaleY(p[py]);
								break;
							case 23:
								p[px] = mapFunc.moveX(p[px]);
								p[py] = mapFunc.scaleY(p[py]);
								break;
							case 31:
								p[py] = mapFunc.moveY(p[py]);
								break;
							case 32:
								p[px] = mapFunc.scaleX(p[px]);
								p[py] = mapFunc.moveY(p[py]);
								break;
							case 33:
								p[px] = mapFunc.moveX(p[px]);
								p[py] = mapFunc.moveY(p[py]);
								break;
						}
					}
				}
				
				result.push(p);
			}, this.paths);
			
		} else {
			// просто масштабируем все точки
			this.traverse(function(/* ictinus.drawItems.Item */ item){
				var p = item.clone();
				
				// не забываем проставлять ссылки на предыдущий/следующий элемент
				if (result.length) {
					p.prev(result[result.length - 1]);
					result[result.length - 1].next(p);
				}
				
				map(p, mapFunc.scaleX, 'x');
				map(p, mapFunc.scaleY, 'y');
				result.push(p);
			}, this.paths);
		}
		
//		return result;
		return this.fixTangents(result);
	},
	
	/**
	 * Добавляет путь к описанию формы
	 * @param {ictunus.draw_type.line()} Один или несколько путей
	 */
//	XXX старый метод, пока не нужен
//	addPath: function(path){
//		for (var i = 0; i < arguments.length; i++) {
//			this.paths.push(arguments[i]);
//		}
//	},
	
	/**
	 * Устанавливает или возвращает масштаб по горизонтали
	 * @param {Number|String} [value] Новое значение масштаба
	 * @return {Number}
	 */
	scaleX: function(value){
		if (arguments.length) {
			this._scaleX = parseFloat(value, 10);
		}
		return this._scaleX;
	},
	
	/**
	 * Устанавливает или возвращает масштаб по вертикали
	 * @param {Number|String} [value] Новое значение масштаба
	 * @return {Number}
	 */
	scaleY: function(value){
		if (arguments.length) {
			this._scaleY = parseFloat(value, 10);
		}
		return this._scaleY;
	},
	
	/**
	 * Устанавливает или возвращает ширину
	 * @param {Number|String} [value] Новое значение ширины
	 * @return {Number}
	 */
	width: function(value){
		var bounds = this.getBounds(true);
		var width = bounds.maxX - bounds.minX;
		
		if (arguments.length) {
			this.scaleX(parseFloat(value, 10) / width);
		}
		
		return width * this.scaleX();
	},
	
	/**
	 * Устанавливает или возвращает высоту
	 * @param {Number|String} [value] Новое значение высоты
	 * @return {Number}
	 */
	height: function(value){
		var bounds = this.getBounds(true);
		var height = bounds.maxY - bounds.minY;
		
		if (arguments.length) {
			this.scaleY(parseFloat(value, 10) / height);
		}
		
		return height * this.scaleY();
	},
	
	/**
	 * Устанавливает сетку масштабирования
	 * @param {Number} x1
	 * @param {Number} x2
	 * @param {Number} y1
	 * @param {Number} y2
	 */
	setScaleGrid: function(x1, x2, y1, y2){
		this.scaleGrid.x1 = Math.min(x1, x2);
		this.scaleGrid.x2 = Math.max(x1, x2);
		this.scaleGrid.y1 = Math.min(y1, y2);
		this.scaleGrid.y2 = Math.max(y1, y2);
	},
	
	/**
	 * Проверяет, является ли сетка масштабирования пустой. Используется для 
	 * проверки необходимости применения такого масштабирования.
	 * @return {Boolean}
	 */
	isEmptyGrid: function(){
		var g = this.scaleGrid;
		return (!g.x1 && !g.x2 && !g.y1 && !g.y2);
	},
	
	/**
	 * Отрисовывет текущую форму. Если передан параметр <code>paths</code>, то
	 * именно этот массив инструкций по рисованию будет использоваться для 
	 * отрисовки, а не внутренний массив. Это полезно использовать, например, 
	 * при создании анимаций, когда нет простого и понятного способа сохранить
	 * оригинал формы и при этом учитывать сетку масшатбирования
	 * @param {Element} target В каком элементе рисовать
	 * @param {Array} [paths] Инструкции для рисования 
	 */
	draw: function (target, paths) {
		this._session.paths = paths;
		ictinus.draw(target, this);
		delete this._session.paths;
	},
	
	/**
	 * Украшает. Если передан параметр <code>paths</code>, то
	 * именно этот массив инструкций по рисованию будет использоваться для 
	 * отрисовки, а не внутренний массив. Это полезно использовать, например, 
	 * при создании анимаций, когда нет простого и понятного способа сохранить
	 * оригинал формы и при этом учитывать сетку масшатбирования
	 * @param {Element} img Картинка, которую нужно украсить
	 * @param {Array} [paths] Инструкции для рисования 
	 */
	decorate: function (img, paths) {
		this._session.paths = paths;
		ictinus.decorate(img, this);
		delete this._session.paths;
	},
	
	/**
	 * Устанавливает для формы рисования. Они нижны, как правило, при работе 
	 * с анимациями. Например, при анимации формы с помощью метода 
	 * <code>easeoutcubic</code> негкоторые точки могут выходить за пределы
	 * холста, что приведет к обрезанию формы. Для этого и нужен padding: 
	 * по сути, он добавляет дополнительный размер canvas-элементу, чтобы 
	 * нормально отображались токи, выходящие за пределы размера формы
	 * @param {String|Number} value Отступы в CSS-формате без указания единиц (например: '10', '20 5 30 10')
	 */
	padding: function(value){
		if (typeof(value) == 'number') {
			this.paddingLeft = this.paddingRight = this.paddingTop = this.paddingBottom = value;
		} else if(typeof(value) == 'string') {
			value = value.split(/\s+/);
			var parse = function(v){
				return parseInt(v, 10);
			}
			
			switch (value.length) {
				case 1:
					this.paddingLeft = this.paddingRight = this.paddingTop = this.paddingBottom = parse(value[0]);
					break;
				case 2:
					this.paddingTop = this.paddingBottom = parse(value[0]);
					this.paddingLeft = this.paddingRight = parse(value[1]);
					break;
				case 3:
					this.paddingTop = parse(value[0]);
					this.paddingLeft = this.paddingRight = parse(value[1]);
					this.paddingBottom = parse(value[2]);
					break;
				case 4:
					this.paddingTop = parse(value[0]);
					this.paddingRight = parse(value[1]);
					this.paddingBottom = parse(value[2]);
					this.paddingLeft = parse(value[3]);
					break;
			}
		}
	},
	
	/**
	 * Обновляет размер формы по габаритам элемента
	 * @param {HTMLElement} elem Элемент, под размеры которого нужно подогнать форму
	 */
	updateSizeBy: function(elem){
		if (this.contentBox.width && this.contentBox.height) {
			// определен контентный блок, обновляем размеры по нему
			this.scaleX(elem.offsetWidth / this.contentBox.width);
			this.scaleY(elem.offsetHeight / this.contentBox.height);
		} else {
			// обновлем размер по габаритам формы
			this.width(elem.offsetWidth);
			this.height(elem.offsetHeight);
		}
	},
	
	/**
	 * Возвращает габаритный прямоугольник текущей формы (с учетом масштабирования)
	 * @param {Boolean} [no_scale] Вернуть габаритный прямоугольник без учета масштабирования 
	 */
	getBounds: function(no_scale){
		var result = {
			minX: 0,
			minY: 0,
			maxX: 0,
			maxY: 0
		};
		
		this.traverse(function(/* ictinus.drawItems.Item */ item){
			var bounds = item.getBounds();
			result.minX = Math.min(result.minX, bounds.minX);
			result.minY = Math.min(result.minY, bounds.minY);
			result.maxX = Math.max(result.maxX, bounds.maxX);
			result.maxY = Math.max(result.maxY, bounds.maxY);
		}, (no_scale) ? this.paths : null);
		
		return result;
	},
	
	/**
	 * Возвращает форму в формате JSON (удобно для передачи и хранения формы)
	 * @return {Object}
	 */
	toJSON: function(){
		/** @return {String} */
		function join() {
			return Array.prototype.join.call(arguments, ' ');
		}
		
		var result = {};
		var props = 'strokeWidth,strokeColor,fillColor'.split(',');
		for (var i = 0; i < props.length; i++) {
			result[props[i]] = this[props[i]];
		}
		
		result.scaleX = this.scaleX();
		result.scaleY = this.scaleY();
		
		result.padding = join(this.paddingTop, this.paddingRight, this.paddingBottom, this.paddingLeft);
		result.contentBox = join(this.contentBox.x, this.contentBox.y, this.contentBox.width, this.contentBox.height);
		result.scaleGrid = join(this.scaleGrid.x1, this.scaleGrid.y1, this.scaleGrid.x2, this.scaleGrid.y2);
		
		var paths = [];
		for (var i = 0; i < this.paths.length; i++) {
			paths.push(this.paths[i].toString());
		}
		result.paths = paths.join('');
		
		return result;
	}
};/**
 * Утилиты для парсинга строки типа SVG Path Data {@link http://www.w3.org/TR/SVG/paths.html#PathData}
 * Это тип был расширен еще одним параметром: O (x1 y1 x2 y2 x y) — кривая Безье,
 * чья косательная должна быть зафиксирована с предыдущей
 * @author Sergey Chikuyonok (serge.che@gmail.com)
 * @copyright Art.Lebedev Studio (http://www.artlebedev.ru)
 * 
 * @include "/ictinus/src/ictinus.js"
 * @include "/ictinus/src/ictinus.drawItems.js"
 * @include "/ictinus/src/ictinus.Shape.js"
 * 
 */
ictinus.Shape.pathData = (function(){
	/**
	 * Обрезает пробелы в начале и в конце текста
	 * @param {String} text
	 * @return {String}
	 */
	function trim(text){
		return (text || '').replace( /^\s+|\s+$/g, '');
	}
	
	/**
	 * Точка
	 * @class
	 */
	function Point(x, y) {
		this.x = x;
		this.y = y;
	}
	
	/**
	 * Конвертирует кривую второго порядка в кривую третьего порядка.
	 * Используется для того, чтобы избавиться от кривых второго порядка 
	 * (quad curve), которые неправильно работают в Fx1.5
	 * @link https://developer.mozilla.org/en/Canvas_tutorial/Drawing_shapes
	 * @param {Number} x0 Начальная X-координата
	 * @param {Number} y0 Начальная Y-координата
	 * @param {Number} cpx X-координата контрольной точки
	 * @param {Number} cpy Y-координата контрольной точки
	 * @param {Number} x1 Конечная X-координата
	 * @param {Number} y1 Конечная Y-координата
	 * 
	 */
	function conv2to3(x0, y0, cpx, cpy, x1, y1) {
		var cp1x = x0 + 2/3 * (cpx - x0);
		var cp1y = y0 + 2/3 * (cpy - y0);
		
		return {
			cp1x: cp1x,
			cp1y: cp1y,
			cp2x: cp1x + (x1 - x0) / 3,
			cp2y: cp1y + (y1 - y0) / 3,
			x: x1,
			y: y1
		};
	}
	
	/**
	 * Пробразует команды рисования кривых SVG в команды рисования иктинуса
	 * @param {Array} svg_commands Команды рисования кривых из SVG (создаются в <code>ictinus.Shape.utils.parsePath</code>)
	 * @return {Array} Команды рисования иктинуса
	 */
	var transformCommands = (function() {
		// Абсолютные координаты последней распарсенной точки 
		var abs_x = 0, abs_y = 0;
		
		/**
		 * Последняя контрольная точка 
		 * (используется в <code>scurveto()</code> и <code>squadto()</code>)
		 * @type {Point}
		 */
		var last_cp;
		
		/** Текущий набор команд рисования иктинуса */
		var commands = [];
		
		/* 
		 * Команды рисования, которые непосредственно переводят вызовы 
		 * из SVG в ictinus
		 */
		
		/** @type {ictinus.drawItems.Item} Последняя добавленная в список команда */
		var last_command = null;
		
		/**
		 * Добавление комманды рисования иктинуса в список
		 * @param {ictinus.drawItems.Item} command
		 */
		function addCommand(command){
			if (last_command) {
				last_command.next(command)
			}
			
			command.prev(last_command);
			commands.push(command);
			last_command = command;
		}
		
		/**
		 * @param {String} command Команда
		 * @param {Array[]|String} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function moveto(command, arg_list, pos) {
			arg_list = expandArgs(arg_list, 2);
			
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				
				/*
				 * command:
				 * M — абсолютное смещение
				 * m — относительное смещение
				 */
				if (command == 'M' || pos == 0) {
					abs_x = arg[0];
					abs_y = arg[1];
				} else {
					abs_x += arg[0];
					abs_y += arg[1];
				}
				
				if (i == 0) {
					addCommand(new ictinus.drawItems.MoveTo(abs_x, abs_y));
				} else {
					// если несколько наборов аргументов, то все, кроме первого,
					// считаются как рисование линии в указанную точку
					addCommand(new ictinus.drawItems.LineTo(abs_x, abs_y));
				}
			}
		}
		
		function closepath(){
//			addCommand(ictinus.draw_type.close());
		}
		
		/**
		 * @param {String} command Команда
		 * @param {Array[]} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function lineto(command, arg_list, pos) {
			arg_list = expandArgs(arg_list, 2);
			
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				
				/*
				 * command:
				 * L — абсолютные координаты
				 * l — относительные координаты
				 */
				switch (command) {
					case 'L':
						abs_x = arg[0];
						abs_y = arg[1];
						break;
					case 'l':
						abs_x += arg[0];
						abs_y += arg[1];
						break;
				}
				
				addCommand(new ictinus.drawItems.LineTo(abs_x, abs_y));
			}
		}
		
		/**
		 * Горизонатльная или вертикальная линия
		 * @param {String} command Команда
		 * @param {Array[]} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function hvlineto(command, arg_list, pos) {
			arg_list = expandArgs(arg_list, 1);
			
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				
				/*
				 * command:
				 * H — горизонтальная линия, абсолютные координаты
				 * h — горизонтальная линия, относительные координаты
				 * V — вертикальная линия, абсолютные координаты
				 * v — вертикальная линия, относительные координаты
				 */
				switch (command) {
					case 'H':
						abs_x = arg[0];
						break;
					case 'h':
						abs_x += arg[0];
						break;
					case 'V':
						abs_y = arg[0];
						break;
					case 'v':
						abs_y += arg[0];
						break;
				}
				
				addCommand(new ictinus.drawItems.LineTo(abs_x, abs_y));
			}
		}
		
		/**
		 * @param {String} command Команда
		 * @param {Array[]} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function curveto(command, arg_list, pos) {
			arg_list = expandArgs(arg_list, 6);
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				
				var locked = (command.toLowerCase() == 'o');
				
				/*
				 * command:
				 * C — абсолютные координаты
				 * c — относительные координаты
				 */
				switch (command) {
					case 'C':
					case 'O':
						addCommand(new ictinus.drawItems.BezierTo(arg[4], arg[5], arg[0], arg[1], arg[2], arg[3], locked));
						last_cp = new Point(arg[2], arg[3]);
						
						abs_x = arg[4];
						abs_y = arg[5];
						break;
					case 'c':
					case 'o':
						addCommand(new ictinus.drawItems.BezierTo(abs_x + arg[4], abs_y + arg[5], abs_x + arg[0], abs_y + arg[1], abs_x + arg[2], abs_y + arg[3], locked));
						last_cp = new Point(abs_x + arg[2], abs_y + arg[3]);
						
						abs_x += arg[4];
						abs_y += arg[5];
						break;
				}
			}
		}
		
		/**
		 * @param {String} command Команда
		 * @param {Array[]} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function scurveto(command, arg_list, pos) {
			arg_list = expandArgs(arg_list, 4);
			
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				
				var tan_cp = ictinus.Shape.calculateTangentPoint(last_cp.x, last_cp.y, last_cp.x, last_cp.y, abs_x, abs_y);
				var locked = true;
				
				/*
				 * command:
				 * S — абсолютные координаты
				 * s — относительные координаты
				 */
				switch (command) {
					case 'S':
						addCommand(new ictinus.drawItems.BezierTo(arg[2], arg[3], tan_cp.x, tan_cp.y, arg[0], arg[1], locked));
						last_cp = new Point(arg[0], arg[1]);
						
						abs_x = arg[2];
						abs_y = arg[3];
						break;
					case 's':
						addCommand(new ictinus.drawItems.BezierTo(abs_x + arg[2], abs_y + arg[3], tan_cp.x, tan_cp.y, abs_x + arg[0], abs_y + arg[1], locked));
						last_cp = new Point(abs_x + arg[0], abs_y + arg[1]);
						
						abs_x += arg[2];
						abs_y += arg[3];
						break;
				}
				
			}
		}
		
		/**
		 * @param {String} command Команда
		 * @param {Array[]} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function quadto(command, arg_list, pos) {
			
			arg_list = expandArgs(arg_list, 4);
			
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				var c3;
				
				/*
				 * command:
				 * Q — абсолютные координаты
				 * q — относительные координаты
				 */
				switch (command) {
					case 'Q':
						c3 = conv2to3(abs_x, abs_y, arg[0], arg[1], arg[2], arg[3]);
						last_cp = new Point(arg[0], arg[1]);
						break;
					case 'q':
						c3 = conv2to3(abs_x, abs_y, abs_x + arg[0], abs_y + arg[1], abs_x + arg[2], abs_y + arg[3]);
						last_cp = new Point(abs_x + arg[0], abs_y + arg[1]);
						break;
				}
				
				addCommand(new ictinus.drawItems.BezierTo(c3.x, c3.y, c3.cp1x, c3.cp1y, c3.cp2x, c3.cp2y, false));
				
				abs_x = c3.x;
				abs_y = c3.y;
			}
		}
		
		/**
		 * @param {String} command Команда
		 * @param {Array[]} arg_list Набор аргументов команды
		 * @param {Number} pos Порядковый номер команды в списке комманд
		 */
		function squadto(command, arg_list, pos) {
			
			arg_list = expandArgs(arg_list, 2);
			
			for (var i = 0; i < arg_list.length; i++) {
				var arg = arg_list[i];
				
				var tan_cp = calculateTangentPoint(last_cp, new Point(abs_x, abs_y));
				var c3;
				
				/*
				 * command:
				 * T — абсолютные координаты
				 * t — относительные координаты
				 */
				switch (command) {
					case 'T':
						c3 = conv2to3(abs_x, abs_y, tan_cp.x, tan_cp.y, arg[0], arg[1]);
						break;
					case 't':
						c3 = conv2to3(abs_x, abs_y, tan_cp.x, tan_cp.y, abs_x + arg[0], abs_y + arg[1]);
						break;
				}
				
				addCommand(new ictinus.drawItems.BezierTo(c3.x, c3.y, c3.cp1x, c3.cp1y, c3.cp2x, c3.cp2y, false));
				last_cp = tan_cp;
				
				abs_x = arg[0];
				abs_y = arg[1];
			}
		}
		
		/**
		 * Рассчитывает координаты второй контрольной точки
		 * для обеспечения сохранности касательной между двумя кривыми Безье
		 * @param {Point} cp1 Точка, <i>относительно</i> которой нужно считать координаты
		 * @param {Point} anchor Концевая точка, которой принадлежат обе контрольные точки
		 * @return {Point}
		 */
		function calculateTangentPoint(cp1, anchor){
			var a = Math.atan2(cp1.y - anchor.y, cp1.x - anchor.x);
			var b = (a + Math.PI) % (Math.PI * 2);
		
			var catet_x = cp1.x - anchor.x;
			var catet_y = cp1.y - anchor.y;
		
			var hypot = Math.sqrt(catet_x * catet_x + catet_y * catet_y);
		
			return new Point(Math.cos(b) * hypot + anchor.x, Math.sin(b) * hypot + anchor.y);
		};
		
		/**
		 * Разбивает строку на набор аргументов.<br>
		 * Разные команды принимают разное количество аргументов. Например, 
		 * команда l (lineto) принимает 2 аргумента, а команда c (curveto) 
		 * принимает 3 аргумента. Стандарт SVG позволяет сцепить несолько 
		 * одинаковых, идущих подряд команд в одну, например: 
		 * l 1,2 l 3,4 можно записать как l 1,2,3,4. Соответственно, после 
		 * <code>parsePath()<code> аргументы команд могут содержать несколько 
		 * вызовов.<br><br> 
		 * 
		 * Текущий метод, во-первых, разбивает строку на массив значений, 
		 * а во-вторых группирует массив по количеству аргументов, необходимых
		 * для вызова команды (параметр <code>count</code>). В результате 
		 * получается массив массивов: первый уровень указывает, сколько всего
		 * вызовов комманды, а второй уровень содержит атрибуты комманды
		 * @param {String} args Аргументы, полученные в <code>parsePath()</code>
		 * @param {Number} count Количество аргументов, необходимых для вызова команды
		 * @return {Array[]}
		 */
		function expandArgs(args, count){
			// парсим только строки. если отдали что-то другое — ничего не делаем
			if (typeof args != 'string') {
				return args;
			}
			
			// сначала достаю все аргументы в один массив
			var re = /(\-?\d+(?:\.\d+)?)/g;
			var tmp, m = [];
			args = trim(args);
			
			while ((tmp = re.exec(args))) {
				m.push(tmp[1]);
			}
			
			// приведем все значения массива к числу
			for (var i = 0; i < m.length; i++) {
				m[i] = parseFloat(m[i], 10);
			}
			
			// теперь делим на группы
			var result = [];
			count = count || 1;
			for (var i = 0; i < m.length; i += count) {
				result.push(m.slice(i, i + count));
			}
			
			return result;
		}
		
		/** Карта команд преобразования */
		var command_map = {
			m: moveto,
			z: closepath,
			l: lineto,
			h: hvlineto,
			v: hvlineto,
			c: curveto,
			o: curveto,
			s: scurveto,
			q: quadto,
			t: squadto
		};
		
		return function(/* Array */ svg_commands) {
			abs_x = abs_y = 0;
			last_command = last_cp = null;
			
			commands = [];
			
			/*
			 * Начинаем преобразовывать команды. По мере исполнения сценария будет 
			 * автоматически заполняться массив commands, который затем возвращается 
			 * как результат
			 */
			for (var i = 0; i < svg_commands.length; i++) {
				var c = svg_commands[i];
				command_map[ c.command.toLowerCase() ](c.command, c.args, i);
			}
		
			return commands;
		}
	})();
	
	return {
		/**
		 * Парсит строку формата path data в набор команд для рисования 
		 * через ictinus
		 * @link http://www.w3.org/TR/SVG/paths.html#PathData
		 * @param {String} path Строка с path data
		 * @return {Array} Набор комманд для рисования
		 */
		parse: function(path){
			var str = trim(path);
			
			// удаляю все переводы строк
			str = str.replace(/\n|\r/g, ' ');
			
			var commands = [], 
				re = /([a-z])/ig, 
				last_ix = 0, 
				m, 
				last_command = null;
			
			function co(name, args){
				commands.push({
					command: name,
					args: trim(args)
				});
			}
			
			// теперь регулярным выражением буду находить буквы и записывать пары 
			// "команда-аргументы"
			while ((m = re.exec(str))) {
				if (last_command !== null) 
					co(
						last_command,
						str.substring(last_ix, re.lastIndex - last_command.length)
					);
				
				last_command = m[0];
				last_ix = re.lastIndex;
			}
			
			// добавляю самую последнюю команду (как правило, это z)
			co(last_command, str.substring(last_ix));
			
			return transformCommands(commands);
		}
	}
})();
/**
 * Импорт формы из SVG
 * @author Sergey Chikuyonok (sc@design.ru)
 * @copyright Art.Lebedev Studio (http://www.artlebedev.ru)
 * @include "/ictinus/src/ictinus.js"
 */
 
ictinus.svgimport = function(){
	// TODO добавить парсинг других форм, например, rect
	// TODO превратить в полноценный редактор (добавить визуальную часть)
	
	return {
		/**
		 * Парсит SVG-файл и возвращает новую форму
		 * @param {Document} svg Документ SVG-файла
		 * @return {ictinus.shape()}
		 */
		read: function(svg){
			var shapes = svg.getElementsByTagName('path');
			
			// считываем оригинальные размеры 
			var width = parseInt(svg.documentElement.getAttribute('width'), 10);
			var height = parseInt(svg.documentElement.getAttribute('height'), 10);
			var path = shapes[0];
			
			var shape = new ictinus.Shape(path.getAttribute('d'), width, height);
			
			shape.fillColor = path.getAttribute('fill');
			shape.strokeColor = path.getAttribute('stroke');
			shape.strokeWidth = parseFloat(path.getAttribute('stroke-width'), 10);
			
			return shape;
		}
		
	}
}();
/**
 * Рисовалка скругленных уголков для картинок
 * @author Sergey Chikuyonok (sc@design.ru)
 * @copyright Art.Lebedev Studio (http://www.artlebedev.ru)
 * @requires ictinus
 * @include "/ictinus/src/ictinus.js"
 */
ictinus.roundCorners = (function(){
	
	var shape_cache = {};
	
	var path_data = 'm 0, %rd ' +
			'c 0, -%r2, %r2, -%rd, %rd, -%rd ' +
			'l %w, 0 ' +
			'c %r2, 0, %rd, %r2, %rd, %rd ' +
			'l 0, %h ' +
			'c 0, %r2, -%r2, %rd, -%rd, %rd ' +
			'l -%w, 0 ' +
			'c -%r2, 0, -%rd, -%r2, -%rd, -%rd ';
	
	var width = 100, height = 100;
	
	/**
	 * Создает форму рисования для ictinus
	 * @param {Number} w Ширина формы
	 * @param {Number} h Высота формы
	 * @param {Number} [radius] Радиус скругления
	 * @return {ictinus.Shape}
	 */
	function createShape(radius){
		
		if (!shape_cache[radius]) {
			var props = {
				rd: radius,
				r2: radius / 2,
				w: width - 2 * radius,
				h: height - 2 * radius
			};
			
			var cur_path = path_data.replace(/(%(\w{1,2}))/g, function(str, p1, p2){
				return props[p2];
			});
			
			var shape =  new ictinus.Shape(cur_path);
			
			shape.scaleGrid = {
				x1: radius,
				y1: radius,
				x2: width - radius,
				y2: height - radius
			};
			
			shape_cache[radius] = shape;
		}
		
		
		return shape_cache[radius];
	}
	
	/**
	 * Сделать скругленные уголки у картинки
	 * @param {Element} img Картинка, для которой нужно сделать скругленные уголки
	 * @param {Number} [radius] Радиус скругления (если не указан, будет использована константа <code>roundedBorder.RADIUS</code>)
	 * @param {Object} [draw_params] Параметры рисования (если не указаны, будет использована константа <code>roundedBorder.DRAW_PARAMS</code>)
	 * @return {ictinus.Shape}
	 */
	function draw(img, radius, draw_params){
		draw_params = draw_params || draw.DRAW_PARAMS;
		var shape = createShape(radius || draw.RADIUS);
		
		shape.updateSizeBy(img);
		
		for (var p in draw_params) if (shape.hasOwnProperty(p)) {
			shape[p] = draw_params[p];
		}
		
		shape.decorate(img);
		return shape;
	}
	
	/** Радиус скругления углов по умолчанию, в пикселях */
	draw.RADIUS = 10;
	
	/** Параметры рисования по умолчанию */
	draw.DRAW_PARAMS = {
		strokeWidth: 0
	};
	
	return draw;
})();