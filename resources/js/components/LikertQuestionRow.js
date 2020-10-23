import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core';
import TableCell from '@material-ui/core/TableCell';
import RadioGroup from '@material-ui/core/RadioGroup';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Radio from '@material-ui/core/Radio';
import FormControl from '@material-ui/core/FormControl';
import { TableRow } from '@material-ui/core';
import { Field } from 'redux-form';
import Typography from '@material-ui/core/Typography';

const LikertQuestionRow = ({
    classes,
    name,
    text,
    input,
    options,
    ...rest
}) => {
    return (
        <div>
            <Typography>{text}</Typography>
            <FormControl component="fieldset">
                <RadioGroup {...input} {...rest}>
                    <ul className={classes.ul}>
                        {options.map((option, idx) => (
                            <li key={idx}>
                                <FormControlLabel
                                    key={idx}
                                    name={name}
                                    label={null}
                                    control={<Radio />}
                                    value={option.value.toString()}
                                />
                            </li>
                        ))}
                    </ul>
                </RadioGroup>
            </FormControl>
        </div>
    );
};

LikertQuestionRow.propTypes = {
    text: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    options: PropTypes.array.isRequired
};

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
