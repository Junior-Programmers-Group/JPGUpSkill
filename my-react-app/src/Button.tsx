import { useState } from "react";

export const CountButton = () => {
  // Button implementation
  const [count, setCount] = useState(0);

  return (
    <>
        <button onClick={() => setCount((count) => count + 1)}>Count is: {count}</button>
    </>
  );
};