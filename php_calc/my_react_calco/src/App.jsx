import { useState } from "react";
import { evaluate } from "mathjs";
import React from "react";
import Input from "./practice/input";
import "./index.css";
import Botton from "./practice/Botton";
const App=() => {
    const [text, setText] = useState("");
    const [result, setResult] = useState("");

    const addToText = (val) =>{
        setText((text) => [...text,val + ""]);
    };
    const calculateResult = () => {
        const input = text.join("")
        setResult(math.evaluate(input));
    };
    const resetInput = () => {
        setText("")
        setResult("")
    }
    return(
       <div className="App">
        <div className="calc-wrapper">
            <Input text={text} result={result}/>
            <div className="row">
            <Botton symbol="7" handleClick={addToText}/>
            <Botton symbol="8" handleClick={addToText}/>
            <Botton symbol="9" handleClick={addToText}/>
            <Botton symbol="/" handleClick={addToText} color="yellow"/>
            </div>

            <div className="row">
            <Botton symbol="4" handleClick={addToText}/>
            <Botton symbol="5" handleClick={addToText}/>
            <Botton symbol="6" handleClick={addToText}/>
            <Botton symbol="*" handleClick={addToText} color="yellow"/>
            </div>  

            <div className="row">
            <Botton symbol="1" handleClick={addToText}/>
            <Botton symbol="2" handleClick={addToText}/>
            <Botton symbol="3" handleClick={addToText}/>
            <Botton symbol="+" handleClick={addToText} color="yellow"/>
            </div>  

             <div className="row">
            <Botton symbol="0" handleClick={addToText}/>
            <Botton symbol="." handleClick={addToText}/>
            <Botton symbol="=" handleClick={calculateResult}/>
            <Botton symbol="-" handleClick={addToText} color="yellow"/>
            </div>
            <Botton symbol="clear" handleClick={resetInput}color="red"/>
        </div>
       </div>
    );
};
export default App;