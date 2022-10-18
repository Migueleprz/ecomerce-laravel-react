import Spinner from "react-bootstrap/Spinner";

function LoadinBoxComponent() {
    return (
        <>
            <Spinner animation="grow" role="status" variant="primary">
                <span className="visually-hidden">Loading...</span>
            </Spinner>
        </>
    )
}

export default LoadinBoxComponent;