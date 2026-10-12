import { useNavigate } from "react-router-dom";
import { CountButton } from "./Button"

export let Page2 = () => {
    let nav = useNavigate();
    
    return (
    <>
        <h1>Page 2</h1>
        <CountButton />
        <button onClick={() => nav('/')}>Go back to root</button>
    </>
    );
}