import React from "react";
import TextField from '@mui/material/TextField';
import {AdapterLuxon} from "@mui/x-date-pickers/AdapterLuxon";
import {LocalizationProvider} from "@mui/x-date-pickers";
import {DatePicker} from "@mui/x-date-pickers";
import {DateTime} from 'luxon';

const dateLuxon = DateTime.now();  // get today's date

export default class ExpenseForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            description: props.expense ? props.expense.description : "",
            amount: props.expense ? (props.expense.amount).toString() : "",
            note: props.expense ? props.expense.note : "",
            dateCreated: props.expense ? DateTime.fromMillis(props.expense.dateCreated) : dateLuxon,
            error: ''

        };
        // cos i am using props, i have to bind the functions to this, if I didn't set the constructor props i wouldn't need to do so
        this.onDescriptionChange = this.onDescriptionChange.bind(this);
        this.onAmountChange = this.onAmountChange.bind(this);
        this.onNoteChange = this.onNoteChange.bind(this);
        this.onDateChange = this.onDateChange.bind(this);
        this.onFocusedChange = this.onFocusedChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }

    onDescriptionChange = (e) => {
        const description = e.target.value;
        this.setState(() => ({description}))
    }

    onAmountChange = (e) => {
        const amount = e.target.value;
        if (!amount || amount.match(/^\d{1,}(\.\d{0,2})?$/)) {
            this.setState(() => ({amount}))
        }
    }
    onNoteChange = (e) => {
        const note = e.target.value;
        this.setState(() => ({note}))
    }

    onDateChange(dateCreated) {
        if (dateCreated) {
            this.setState({dateCreated})
        }
    }

    onFocusedChange = ({focused}) => {
        this.setState(() => ({calenderFocused: focused}))
    }
    onSubmit = (e) => {
        e.preventDefault();
        if (!this.state.description || !this.state.amount || !this.state.dateCreated) // if the description amount and dateCreated are empty
        {
            this.setState({error: "An error has been detected"});
        } else {
            this.setState({error: ""});
            /* here i am using a combination of object destructuring and spread operators
            RHS:
            i am spreading out the state, which is an object, and modifying the amount and dateCreated values
            LHS:
            i am taking the spread out object on the lhs and destructuring it into the expense but i am omitting the error property because i do not need it
            */
            const {error, ...expense} = {
                ...this.state,
                amount: parseFloat(this.state.amount),
                dateCreated: this.state.dateCreated.ts
            }
            this.props.onSubmit(expense) // passing the object to the props
        }

    }
    render() {
        return (
            <div>
                <form onSubmit={this.onSubmit}>
                    <input type='text' placeholder='Description' autoFocus value={this.state.description}
                           onChange={this.onDescriptionChange}/>
                    <input type='string' placeholder='amount' value={this.state.amount} onChange={this.onAmountChange}/>
                    <LocalizationProvider dateAdapter={AdapterLuxon}>
                        <DatePicker
                            label='Pick a date'
                            onChange={this.onDateChange}
                            value={this.state.dateCreated}
                            renderInput={(params) => <TextField {...params} />}
                            mask="__/__/____ __:__"
                        />
                    </LocalizationProvider>
                    <textarea placeholder='Add a note' value={this.state.note} onChange={this.onNoteChange}></textarea>
                    <button> Add Expense</button>
                    {/* if there is something in error display the label*/}
                    {this.state.error && <label htmlFor='error' style={{color: 'green'}}> {this.state.error} </label>
                    }
                </form>
            </div>
        )
    }
}

