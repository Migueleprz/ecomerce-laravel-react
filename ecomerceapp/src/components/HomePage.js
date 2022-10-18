//import data from "../data";
import {useEffect, useReducer, useState} from "react";
import axios from "axios";
import {Col, Row} from "react-bootstrap";
import ProductoComponent from "./shared/ProductoComponent";
import {Helmet} from "react-helmet-async";
import LoadinBoxComponent from "./shared/LoadinBoxComponent";
import AlertComponent from "./shared/AlertComponent";

const reducer = (state, action) => {
    switch (action.type) {
        case 'FETCH_REQUEST':
            return {...state, loading: true}
        case 'FETCH_SUCCESS':
            return {...state, productos: action.payload, loading: false}
        case 'FETCH_FAIL':
            return {...state, loading: false, error: action.payload}
        default:
            return state
    }
}

function HomePage() {
    const [{loading, error, productos}, dispatch] = useReducer(reducer, {
        productos: [],
        loading: true,
        error: ''
    });
    useEffect(() => {
        const fechData = async () => {
            dispatch({type: 'FETCH_REQUEST'});
            try {
                const res = await axios.get('/productos');
                dispatch({type: 'FETCH_SUCCESS', payload: res.data})
            } catch (err) {
                dispatch({type: 'FETCH_FAIL', payload: err.message})
            }
        };
        fechData();
    }, [])

    return (
        <>
            <Helmet><title>Variedades</title></Helmet>
            <h1>Lista de Productos</h1>
            <div className="productos">

                {
                    loading ? (
                            <LoadinBoxComponent/>
                        ) :
                        error ? (
                            <AlertComponent variant="danger" title="Error!" message={error} />
                        ) : (

                            <Row>
                                {
                                    productos.map(p => (
                                        <Col sm={6} md={4} lg={4} className="mb-3" key={p.id}>
                                            <ProductoComponent producto={p}/>
                                        </Col>
                                    ))
                                }
                            </Row>
                        )
                }
            </div>
        </>
    );
}

export default HomePage;