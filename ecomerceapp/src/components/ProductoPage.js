import {useNavigate, useParams} from "react-router";
import {useContext, useEffect, useReducer} from "react";
import axios from "axios";
import {Col, ListGroup, ListGroupItem, Row, Button} from "react-bootstrap";
import PuntuancionComponent from "./shared/PuntuancionComponent";
import {Helmet} from "react-helmet-async";
import LoadinBoxComponent from "./shared/LoadinBoxComponent";
import AlertComponent from "./shared/AlertComponent";
import {getError} from "../core/getError";
import {Store} from "../core/Store";

const reducer = (state, action) => {
    switch (action.type) {
        case 'FETCH_REQUEST':
            return {...state, loading: true}
        case 'FETCH_SUCCESS':
            return {...state, producto: action.payload, loading: false}
        case 'FETCH_FAIL':
            return {...state, loading: false, error: action.payload}
        default:
            return state
    }
}

function ProductoPage() {
    const navigate = useNavigate();
    const params = useParams();
    const {id} = params;

    const [{loading, error, producto}, dispatch] = useReducer(reducer, {
        producto: [],
        loading: true,
        error: ''
    });
    useEffect(() => {
        const fechData = async () => {
            dispatch({type: 'FETCH_REQUEST'});
            try {
                const res = await axios.get(`/productos/${id}`);
                //console.log(res.data.nombre)
                dispatch({type: 'FETCH_SUCCESS', payload: res.data})
            } catch (err) {
                dispatch({type: 'FETCH_FAIL', payload: getError(err.data)})
            }
        };
        fechData();
    }, [id]);

    const {state, dispatch: ctxDispatch} = useContext(Store);
    const {cart} = state;
    const addToCart = async () => {
        const existItem = cart.cartItems.find((x) => x.id === producto.id);
        const cant = existItem ? existItem.cant + 1 : 1;
        const {data} = await axios.get(`/productos/${producto.id}`);
        //console.log('Stock:' + data.stock)
       // console.log('cant:' + cant)
        if (cant > data.stock) {
            alert('Lo sentimos. no tenemos esta cantidad');
            return;
        }
        ctxDispatch({type: 'CART_ADD_ITEM', payload: {...producto, cant}});
        navigate('/cart')
    }

    return loading ? (
        <LoadinBoxComponent/>
    ) : error ? (
        <AlertComponent variant="danger" title="Error!">{error}</AlertComponent>
    ) : (
        <div className="mt-5">
            <Row>
                <Col md={4}>
                    <img
                        className="img-large"
                        src={producto.image_path + producto.image}
                        alt={producto.nombre}
                    />
                    <div className="mt-2 p-2">
                        <PuntuancionComponent rating={3.6} numReview={5 * producto.id}/>
                    </div>
                </Col>
                <Col md={6}>
                    <ListGroup variant="flush">
                        <ListGroupItem>
                            <Helmet><title>{producto.nombre}</title></Helmet>
                            <h1>{producto.nombre}</h1>
                        </ListGroupItem>
                        <ListGroupItem>Marca: {producto.marcas.nombre}</ListGroupItem>
                        <ListGroupItem>Para: {producto.sex.nombre}</ListGroupItem>
                        <ListGroupItem>Precio: ${producto.precio}</ListGroupItem>
                        <ListGroupItem>Descripción: {producto.descripcion}</ListGroupItem>
                        <ListGroupItem>Existecia: {producto.stock}</ListGroupItem>
                        <ListGroupItem>
                            <Button
                                variant="primary"
                                onClick={addToCart}
                            >Agregar <i className="fa-solid fa-cart-shopping"/>
                            </Button>
                        </ListGroupItem>
                    </ListGroup>
                </Col>
            </Row>
        </div>
    );

}

export default ProductoPage;