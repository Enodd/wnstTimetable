import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function Login({
  status,
  canResetPassword,
}: {
  status?: string;
  canResetPassword: boolean;
}) {
  const {
    data, setData, post, processing, errors, reset 
  } = useForm({
    email: '',
    password: '',
    remember: false as boolean,
  });

  const submit: FormEventHandler = (e) => {
    e.preventDefault();

    post(route('login'), { onFinish: () => reset('password') });
  };

  return (
    <GuestLayout>
      <Head title='Log in' />
      {status && (
        <div className='mb-4 text-sm font-medium text-green-600'>
          {status}
        </div>
      )}
      <form onSubmit={submit}>
        <div>
          <InputLabel
            htmlFor='email'
            value='Email' />
          <TextInput
            autoComplete='username'
            className='mt-1 block w-full'
            id='email'
            isFocused={true}
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
            autoComplete='current-password'
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
        <div className='mt-4 block'>
          <label className='flex items-center'>
            <Checkbox
              checked={data.remember}
              name='remember'
              onChange={(e) =>
                setData(
                  'remember',
                  (e.target.checked || false) as false
                )
              }
            />
            <span className='ms-2 text-sm text-gray-600'>
              Remember me
            </span>
          </label>
        </div>
        <div className='mt-4 flex items-center justify-end'>
          {canResetPassword && (
            <Link
              className='rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'
              href={route('password.request')}
            >
              Forgot your password?
            </Link>
          )}
          <PrimaryButton
            className='ms-4'
            disabled={processing}>
            Log in
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  );
}
