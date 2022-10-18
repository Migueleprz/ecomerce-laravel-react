import {Link} from "react-router-dom";
import {Button, Card} from "react-bootstrap";
import PuntuancionComponent from "./PuntuancionComponent";

function ProductoComponent(props) {
    const {producto} = props;
    return (
        <div>
            <Card style={{width: '20.2rem'}}>
                <Link to={`/producto/${producto.id}/${producto.slug_nombre}`}>
                    <Card.Img
                        variant="top"
                        src={producto.image_path + producto.image}
                        alt={producto.nombre}
                        style={{width: '20rem'}}
                    />
                </Link>
                <Card.Body>
                    <Card.Title>{producto.nombre}</Card.Title>
                    <Card.Text>Precio: <strong>${producto.precio}</strong></Card.Text>
                    <Card.Text>Marca: {producto.marcas.nombre}</Card.Text>
                    <PuntuancionComponent rating={3.6} numReview={5*producto.id}/>


                </Card.Body>
            </Card>
        </div>
    );
}

export default ProductoComponent;