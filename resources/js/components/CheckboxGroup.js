import React from 'react';
import FormControl from '@material-ui/core/FormControl';
import FormGroup from '@material-ui/core/FormGroup';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';

const CheckboxGroup = ({ label, name, options, input, meta }) => (
    <FormControl>
        <FormGroup>
            {options.map((option, idx) => (
                <div key={idx}>
                    <FormControlLabel
                        control={<Checkbox />}
                        label={option.text}
                        name={`${name}[${idx}]`}
                        value={option.value}
                        checked={input.value.indexOf(option.value) !== -1}
                        onChange={(event) => {
                            const newValue = [...input.value];
                            if (event.target.checked) {
                                newValue.push(option.value);
                            } else {
                                newValue.splice(
                                    newValue.indexOf(option.text),
                                    1
                                );
                            }

                            return input.onChange(newValue);
                        }}
                    />
                </div>
            ))}
        </FormGroup>
    </FormControl>
);

export default CheckboxGroup;
