import React from 'react';
import Modal from 'react-modal';


// we are going to be using stateless functional component that does not need to manage state

const OptionModal = (props) => (
    <Modal
        // this converts the value to boolean values
        isOpen={!!props.selectedOption}
        contentLabel="Selected Options"
        onRequestClose={props.handleClearSelectedOption}
        closeTimeoutMS={100}
        className="modal"
    >
        <h3 className='modal__title'> Selected Options </h3>
        {props.selectedOption && <p className='modal__body'> {props.selectedOption} </p>}
        <button className='button' onClick={props.handleClearSelectedOption}> Close</button>

    </Modal>
);
export default OptionModal;