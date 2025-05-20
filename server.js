const express = require('express');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());

const wordList = ['python', 'hangman', 'challenge', 'programming', 'developer'];

// Route handler for the root URL
app.get('/', (req, res) => {
    // Serve the Hangman game interface directly
    res.send(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hangman Game</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f0f0f0;
                    margin: 0;
                }

                #game-container {
                    text-align: center;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                #word-display {
                    font-size: 24px;
                    letter-spacing: 5px;
                }

                #letter-input {
                    font-size: 18px;
                    padding: 5px;
                    margin-top: 10px;
                }

                #guess-button {
                    font-size: 18px;
                    padding: 5px 10px;
                    margin-top: 10px;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <div id="game-container">
                <h1>Hangman Game</h1>
                <p id="word-display">_ _ _ _ _ _ _ _</p>
                <p>Attempts remaining: <span id="attempts-remaining">6</span></p>
                <input type="text" id="letter-input" maxlength="1" placeholder="Guess a letter">
                <button id="guess-button">Guess</button>
                <p id="message"></p>
            </div>
            <script>
                // JavaScript code will go here
            </script>
        </body>
        </html>
    `);
});

// Route handler for the /word endpoint
app.get('/word', (req, res) => {
    const word = wordList[Math.floor(Math.random() * wordList.length)];
    res.json({ word });
});

app.listen(port, () => {
    console.log(`Hangman game server running at http://localhost:${port}`);
});

