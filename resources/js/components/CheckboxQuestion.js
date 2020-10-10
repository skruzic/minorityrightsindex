import React, { useState } from 'react';
import PropTypes from 'prop-types';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormControl from '@material-ui/core/FormControl';
import FormLabel from '@material-ui/core/FormLabel';
import FormGroup from '@material-ui/core/FormGroup';
import FormHelperText from '@material-ui/core/FormHelperText';
import Typography from '@material-ui/core/Typography';

const CheckboxQuestion = ({ name, text, input, options, ...rest }) => {
    const [value, setValue] = useState({});

    const handleChange = event => {
        setValue({ ...value, [event.target.value]: event.target.checked });
    };

    return (
        <div>
            <Typography>{text}</Typography>
            <FormControl component="fieldset">
                <FormGroup {...input} {...rest}>
                    {options.map((option, idx) => (
                        <FormControlLabel
                            key={idx}
                            control={<Checkbox />}
                            label={option.text}
                            value={option.value}
                        />
                    ))}
                </FormGroup>
            </FormControl>
        </div>
    );
};

export default CheckboxQuestion;
