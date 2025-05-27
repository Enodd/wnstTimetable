import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function ResetPassword({
  token,
  email,
}: {
  token: string;
  email: string;
}) {
  const {
    data, setData, post, processing, errors, reset 
  } = useForm({
    token: token,
    email: email,
    password: '',
    password_confirmation: '',
  });

  const submit: FormEventHandler = (e) => {
    e.preventDefault();

    post(route('password.store'), { onFinish: () => reset('password', 'password_confirmation') });
  };

  return (
    <GuestLayout>
      <Head title='Reset Password' />
      <form onSubmit={submit}>
        <div>
          <InputLabel
            htmlFor='email'
            value='Email' />
          <TextInput
            autoComplete='username'
            className='mt-1 block w-full'
            id='email'
            name='email'
            type='email'
            value={data.email}
            onChange={(e) => setData('email', e.target.value)}
          />
          <InputError
            className='mt-2'
            message={errors.email} />
        </div>
        <div className='mt-4'>
          <InputLabel
            htmlFor='password'
            value='Password' />
          <TextInput
            autoComplete='new-password'
            className='mt-1 block w-full'
            id='password'
            isFocused={true}
            name='password'
            type='password'
            value={data.password}
            onChange={(e) => setData('password', e.target.value)}
          />
          <InputError
            className='mt-2'
            message={errors.password} />
        </div>
        <div className='mt-4'>
          <InputLabel
            htmlFor='password_confirmation'
            value='Confirm Password'
          />
          <TextInput
            autoComplete='new-password'
            className='mt-1 block w-full'
            name='password_confirmation'
            type='password'
            value={data.password_confirmation}
            onChange={(e) =>
              setData('password_confirmation', e.target.value)
            }
          />
          <InputError
            className='mt-2'
            message={errors.password_confirmation}
          />
        </div>
        <div className='mt-4 flex items-center justify-end'>
          <PrimaryButton
            className='ms-4'
            disabled={processing}>
            Reset Password
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  );
}
