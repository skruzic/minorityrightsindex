import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { withStyles } from '@material-ui/core';
import { compose } from 'redux';
import TableCell from '@material-ui/core/TableCell';
import Radio from '@material-ui/core/Radio';
import { TableRow } from '@material-ui/core';

const LikertQuestionRow = ({
    classes,
    question,
    input,
    options,
    currentStep,
    invite,
    saveFn,
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
                        color="secondary"
                        onChange={e => {
                            setSelectedValue(parseInt(e.target.value));
                        }}
                        onBlur={() => {
                            saveFn({
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

export default withStyles(styles)(LikertQuestionRow);
