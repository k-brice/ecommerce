import "./botton.css";

const Botton = ({symbol, color, handleClick}) => {
    return (
    <div 
    onClick={() => handleClick(symbol)}
    className="botton-wrapper" style={{backgroundColor: color}}>
        {symbol}
        </div>
    );
};
export default Botton;