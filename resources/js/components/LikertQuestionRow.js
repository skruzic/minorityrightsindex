import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { withStyles } from '@material-ui/core';
import { compose } from 'redux';
import TableCell from '@material-ui/core/TableCell';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Radio from '@material-ui/core/Radio';
import FormControl from '@material-ui/core/FormControl';
import { TableRow } from '@material-ui/core';
import { saveResponse } from '../slices/campaignsSlice';
import LikertQuestion from './LikertQuestion';

const LikertQuestionRow = ({
    classes,
    question,
    input,
    options,
    currentStep,
    invite,
    saveResponse,
    ...rest
}) => {
    const [selectedValue, setSelectedValue] = useState(-1);

    return (
        <TableRow key={question.id} {...input}>
            <TableCell>{question.text}</TableCell>
            {options.map((option, idx) => (
                <TableCell key={idx}>
                    <Radio
                        checked={option.value === selectedValue}
                        value={option.value}
                        color="primary"
                        onChange={e => {
                            setSelectedValue(parseInt(e.target.value));
                        }}
                        onBlur={() => {
                            saveResponse({
                                invite_id: invite.id,
                                question_id: question.id,
                                answer: selectedValue,
                                page: currentStep + 1
                            });
                        }}
                    />
                </TableCell>
            ))}
        </TableRow>
    );
};

/*LikertQuestionRow.propTypes = {
    text: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    options: PropTypes.array.isRequired
};*/

const styles = {
    ul: {
        listStyle: 'none',
        width: '100%',
        margin: 0,
        padding: '0 0 35px',
        display: 'block'
        //border-bottom:2px solid #efefef;
    }
};

export default compose(
    withStyles(styles),
    connect(null, { saveResponse })
)(LikertQuestionRow);
