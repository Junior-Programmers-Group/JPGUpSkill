export interface TitleProp{
    title: string;
}

export let Title = (props : TitleProp) => {
    return (
        <>
            <h1>{props.title}</h1>
        </>
    );
}