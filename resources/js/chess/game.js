// utils --------------------------------------------------
const STORAGE_KEY = "_chess_game";
const BOARD_DOM_ID = "#board-js";
const whiteSquareGrey = "#a9a9a9";
const blackSquareGrey = "#696969";

const $ = (el) => document.querySelector(el);
const $$ = (el) => document.querySelectorAll(el);
const showEl = (el) => el.classList.remove("hidden");
const hideEl = (el) => el.classList.add("hidden");

// Elements --------------------------------------------------
const $boardEl = $(BOARD_DOM_ID);
const $modalGame = $("#modal-game");
const $modalPromotion = $("#modal-promotion");

const $gameOverBanner = $("#game-over-banner");
const $gameOverMessage = $gameOverBanner.querySelector("#game-over-message");
const $btnRestartGame = $gameOverBanner.querySelector(
    '[data-btn-action="restart-game"]',
);

const $modalCloseBtn = $modalGame.querySelector("[data-bs-dismiss]");
const $newGameSection = $modalGame.querySelector("[data-state='new-game']");
const $continueGameSection = $modalGame.querySelector(
    "[data-state='resume-game']",
);

const $btnStartNewGame = $modalGame.querySelector(
    "[data-btn-action='start-new-game']",
);
const $btnContinueGame = $modalGame.querySelector(
    "[data-btn-action='continue-game']",
);
const $btnResetNewGame = $modalGame.querySelector(
    "[data-btn-action='reset-new-game']",
);

console.log(Chessboard, Chess);

const gameState = {
    _board: null,
    _turn: null,
    _orientation: null,
    _engine: null,
    makeBoard: function (opts, fen) {
        if (this._board) {
            this._board.destroy();
        }
        this._board = new Chessboard($boardEl, opts);
        this._engine = new Chess(fen);
    },
    resize: function () {
        if (this._board) {
            this._board.resize();
        }
    },
    get board() {
        return this._board;
    },
    get position() {
        return this._board ? this._board.fen() : null;
    },
    get orientation() {
        return this._orientation;
    },
    set orientation(newOrientation) {
        this._orientation = newOrientation;
    },
    // Engine -------------------------
    get fen() {
        return this._engine ? this._engine.fen() : null;
    },
    get engine() {
        return this._engine;
    },
    game_over() {
        return this._engine ? this._engine.game_over() : null;
    },
    turn() {
        return this._engine ? this._engine.turn() : null;
    },
    // Engine -------------------------
    updatePosition() {
        this._board.position(this._engine.fen(), true);
    },
};

// let boardGame = null;
// let turn = null;
// let userColor = null;

// // Functions --------------------------------------------------
// function hiddenModal() {
//     hideEl($modalGame);
// }
// function showModal() {
//     showEl($modalGame);
// }
// function hiddenCloseBtn() {
//     hideEl($modalCloseBtn);
// }
// function showCloseBtn() {
//     showEl($modalCloseBtn);
// }

// function showNewGameModal() {
//     hiddenCloseBtn();
//     showEl($newGameSection);
//     hideEl($continueGameSection);
//     showModal();
// }
// function showResumeGameModal() {
//     hiddenCloseBtn();
//     showEl($continueGameSection);
//     hideEl($newGameSection);
//     showModal();
// }

// function showPromotionDialog(color, callback) {
//     // Mostrar el modal
//     showEl($modalPromotion);

//     const pieces = ["q", "r", "b", "n"];
//     const pieceImages = $modalPromotion.querySelectorAll("img[data-piece]");
//     pieceImages.forEach(function (img, idx) {
//         img.src = `modules/chessboardjs/img/chesscom/${color}${pieces[idx].toUpperCase()}.png`;
//     });

//     function onSelectPromotionPiece(event) {
//         const promotionPiece = event.target.getAttribute("data-piece");
//         hideEl($modalPromotion);
//         pieceImages.forEach(function (img) {
//             img.removeEventListener("click", onSelectPromotionPiece);
//         });
//         callback(promotionPiece);
//     }

//     pieceImages.forEach(function (img) {
//         img.addEventListener("click", onSelectPromotionPiece);
//     });
// }

// function showGameOverBanner(message) {
//     $gameOverMessage.textContent = message;
//     showEl($gameOverBanner);
// }

// function hideGameOverBanner() {
//     hideEl($gameOverBanner);
// }

// function removeGreySquares() {
//     // $(`${BOARD_DOM_ID} .square-55d63`).css('background', '')
//     // $(`${BOARD_DOM_ID} .square-55d63`).style.background = ''
//     $$(`${BOARD_DOM_ID} .square-55d63`).forEach(
//         (el) => (el.style.background = ""),
//     );
// }
// function greySquare(square) {
//     const $square = $(`${BOARD_DOM_ID} .square-` + square);

//     let background = whiteSquareGrey;
//     if ($square.classList.contains("black-3c85d")) {
//         background = blackSquareGrey;
//     }

//     $square.style.background = background;
// }

// // State --------------------------------------------------

// function getState() {
//     const strState = localStorage.getItem(STORAGE_KEY);
//     if (strState) {
//         return JSON.parse(strState);
//     }
//     return;
// }
// function setState() {
//     localStorage.setItem(
//         STORAGE_KEY,
//         JSON.stringify({
//             orientation: gameState.orientation,
//             turn: gameState.turn(),
//             fen: gameState.fen,
//             // position: gameState.position
//         }),
//     );
// }

// // Game engine --------------------------------------------------

// function onDragStart(source, piece, position, orientation) {
//     // do not pick up pieces if the game is over
//     if (gameState.game_over()) return false;
//     // only pick up pieces for the side to move
//     if (
//         (gameState.turn() === "w" && piece.search(/^b/) !== -1) ||
//         (gameState.turn() === "b" && piece.search(/^w/) !== -1)
//     ) {
//         return false;
//     }
// }

// function onDrop(source, target) {
//     removeGreySquares();

//     // see if the move is legal
//     const move = gameState.engine.move({
//         from: source,
//         to: target,
//         promotion: "q", // NOTE: always promote to a queen for example simplicity
//     });
//     // illegal move
//     if (move === null) return "snapback";
//     // updateStatus()
//     if (move.flags.includes("p")) {
//         // Deshacemos el movimiento
//         gameState.engine.undo();

//         // Mostramos el diálogo de promoción
//         showPromotionDialog(gameState.turn(), function (promotionPiece) {
//             // Realizamos el movimiento con la pieza de promoción seleccionada
//             const move = gameState.engine.move({
//                 from: source,
//                 to: target,
//                 promotion: promotionPiece,
//             });
//             gameState.updatePosition();
//             updateStatus();
//         });
//         // Retornamos 'snapback' para evitar que el movimiento se realice inmediatamente
//         return "snapback";
//     } else {
//         // gameState.updatePosition();
//         updateStatus();
//     }
// }

// function onMouseoverSquare(square, piece) {
//     // get list of possible moves for this square
//     const moves = gameState.engine.moves({
//         square: square,
//         verbose: true,
//     });

//     // exit if there are no moves available for this square
//     if (moves.length === 0) return;

//     // highlight the square they moused over
//     greySquare(square);

//     // highlight the possible squares for this piece
//     for (var i = 0; i < moves.length; i++) {
//         greySquare(moves[i].to);
//     }
// }
// function onMouseoutSquare(square, piece) {
//     removeGreySquares();
// }

// // update the board position after the piece snap
// // for castling, en passant, pawn promotion
// function onSnapEnd() {
//     gameState.updatePosition();
// }

// function updateStatus() {
//     const stateColor = gameState.engine.turn() === "w" ? "White" : "Black";
//     if (gameState.engine.in_checkmate()) {
//         const nextColor =
//             gameState.engine.turn() === "w" ? "Negras" : "Blancas";
//         showGameOverBanner(`¡Jaque mate! Las ${nextColor} ganan.🎉🥳`);
//     } else if (gameState.engine.in_draw()) {
//         showGameOverBanner("El juego ha terminado en tablas.");
//     } else {
//         console.log(`${stateColor} is to Move`);
//         if (gameState.engine.in_check()) {
//             console.log(`${stateColor} is in check!`);
//         }
//     }
//     if (gameState.game_over()) {
//         console.log("Game over");
//     }

//     setState();
// }

// // Board --------------------------------------------------

// function makeBoard(opts, fen) {
//     gameState.makeBoard(
//         {
//             ...opts,
//             pieceTheme: "modules/chessboardjs/img/chesscom/{piece}.png",
//         },
//         fen,
//     );
// }
// function makeExtendBoard(opts, fen) {
//     makeBoard(
//         {
//             ...opts,
//             showNotation: true,
//             draggable: true,
//             onDragStart: onDragStart,
//             onDrop: onDrop,
//             onSnapEnd: onSnapEnd,
//             onMouseoutSquare: onMouseoutSquare,
//             onMouseoverSquare: onMouseoverSquare,
//         },
//         fen,
//     );
// }
// // Action functions--------------------------------------------------

// function instanceBoard(color, turn = "white", fen) {
//     makeExtendBoard(
//         {
//             position: fen ?? "start",
//             orientation: color,
//         },
//         fen,
//     );
//     gameState.orientation = color;
// }

// function startNewGame() {
//     const selectedColor = $modalGame.querySelector(
//         'input[name="color"]:checked',
//     );
//     if (!selectedColor) {
//         return;
//     }
//     const color =
//         selectedColor.value == "random"
//             ? Math.random() >= 0.5
//                 ? "black"
//                 : "white"
//             : selectedColor.value;
//     instanceBoard(color);
//     setState();
//     hiddenModal();
// }

// function continueGame() {
//     const currentState = getState();
//     instanceBoard(
//         currentState.orientation,
//         currentState.turn,
//         currentState.fen,
//     );
//     hiddenModal();
//     updateStatus();
// }

// // Events --------------------------------------------------
// $modalCloseBtn.addEventListener("click", function () {
//     $modalGame.classList.add("hidden");
//     $modalGame.classList.remove("flex");
// });
// $btnStartNewGame.addEventListener("click", startNewGame);
// $btnResetNewGame.addEventListener("click", function () {
//     confirm("¿Estás seguro de que quieres reiniciar el juego?") &&
//         (function () {
//             hiddenModal();
//             showNewGameModal();
//         })();
// });
// $btnContinueGame.addEventListener("click", continueGame);
// $btnRestartGame.addEventListener("click", function () {
//     hideGameOverBanner();
//     showNewGameModal();
// });

// // Proccess --------------------------------------------------

// makeBoard();
// window.addEventListener("resize", function () {
//     gameState.resize();
// });

// // Start --------------------------------------------------

// if (getState()) {
//     showResumeGameModal();
// } else {
//     showNewGameModal();
// }
