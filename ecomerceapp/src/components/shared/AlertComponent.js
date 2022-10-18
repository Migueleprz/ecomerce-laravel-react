import Alert from "react-bootstrap/Alert";

function AlertComponent(props){

    return(
        <>
            <Alert variant={props.variant || 'info'}>
                <Alert.Heading>{props.title}</Alert.Heading>
                <p>{props.message}</p>
            </Alert>
        </>
    )
}

export default AlertComponent;