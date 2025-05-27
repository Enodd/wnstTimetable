import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function Register() {
  const {
    data, setData, post, processing, errors, reset 
  } = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  const submit: FormEventHandler = (e) => {
    e.preventDefault();

    post(route('register'), { onFinish: () => reset('password', 'password_confirmation') });
  };

  return (
    <GuestLayout>
      <Head title='Register' />
      <form onSubmit={submit}>
        <div>
          <InputLabel
            htmlFor='name'
            value='Name' />
          <TextInput
            required
            autoComplete='name'
            className='mt-1 block w-full'
            id='name'
            isFocused={true}
            name='name'
            value={data.name}
            onChange={(e) => setData('name', e.target.value)}
          />
          <InputError
            className='mt-2'
            message={errors.name} />
        </div>
        <div className='mt-4'>
          <InputLabel
            htmlFor='email'
            value='Email' />
          <TextInput
            required
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
            required
            autoComplete='new-password'
            className='mt-1 block w-full'
            id='password'
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
            required
            autoComplete='new-password'
            className='mt-1 block w-full'
            id='password_confirmation'
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
          <Link
            className='rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'
            href={route('login')}
          >
            Already registered?
          </Link>
          <PrimaryButton
            className='ms-4'
            disabled={processing}>
            Register
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  );
}
