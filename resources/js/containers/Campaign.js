import React, { Component } from 'react';
import { connect } from 'react-redux';
import { reduxForm, Field } from 'redux-form';
import { compose } from 'redux';
import {
    fetchCampaignById,
    selectCampaignById
} from '../slices/campaignsSlice';
import RadioQuestion from '../components/RadioQuestion';
import CheckboxQuestion from '../components/CheckboxQuestion';
import TextQuestion from '../components/TextQuestion';

class Campaign extends Component {
    componentDidMount() {
        this.props.fetchCampaignById(6);
    }

    onSubmit(formValues) {
        console.log(formValues);
    }

    renderQuestion(question) {
        switch (question.type) {
            case 0:
            case 1:
                return (
                    <Field
                        key={question.id}
                        component={TextQuestion}
                        name={question.code}
                        text={question.text}
                        questionType={question.type}
                    />
                );
            case 2:
                return (
                    /*<Field
                        key={question.id}
                        component={RadioQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />*/
                    <Field
                        key={question.id}
                        component={RadioQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />
                );
            case 3:
                return (
                    <Field
                        key={question.id}
                        component={CheckboxQuestion}
                        name={question.code}
                        text={question.text}
                        options={question.optiongroup.options}
                    />
                );
            case 4:
                return null;
            case 5:
                return null;
            case 6:
                return null;
            default:
                return null;
        }
    }

    render() {
        const { campaign, handleSubmit } = this.props;

        return (
            <form onSubmit={handleSubmit(this.onSubmit)}>
                {campaign &&
                    campaign.questions.map(q => this.renderQuestion(q))}
            </form>
        );
    }
}

const mapStateToProps = state => {
    return {
        campaign: selectCampaignById(state, 6)
    };
};

export default compose(
    reduxForm({ form: 'campaignForm' }),
    connect(mapStateToProps, { fetchCampaignById })
)(Campaign);
