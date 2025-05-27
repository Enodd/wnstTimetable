import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { FormEventHandler, useRef } from 'react';

export default function UpdatePasswordForm({ className = '' }: {
  className?: string;
}) {
  const passwordInput = useRef<HTMLInputElement>(null);
  const currentPasswordInput = useRef<HTMLInputElement>(null);

  const {
    data,
    setData,
    errors,
    put,
    reset,
    processing,
    recentlySuccessful,
  } = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
  });

  const updatePassword: FormEventHandler = (e) => {
    e.preventDefault();

    put(route('password.update'), {
      preserveScroll: true,
      onSuccess: () => reset(),
      onError: (errors) => {
        if (errors.password) {
          reset('password', 'password_confirmation');
          passwordInput.current?.focus();
        }

        if (errors.current_password) {
          reset('current_password');
          currentPasswordInput.current?.focus();
        }
      },
    });
  };

  return (
    <section className={className}>
      <header>
        <h2 className='text-lg font-medium text-gray-900'>
          Update Password
        </h2>
        <p className='mt-1 text-sm text-gray-600'>
          Ensure your account is using a long, random password to stay
          secure.
        </p>
      </header>
      <form
        className='mt-6 space-y-6'
        onSubmit={updatePassword}>
        <div>
          <InputLabel
            htmlFor='current_password'
            value='Current Password'
          />
          <TextInput
            autoComplete='current-password'
            className='mt-1 block w-full'
            id='current_password'
            ref={currentPasswordInput}
            type='password'
            value={data.current_password}
            onChange={(e) =>
              setData('current_password', e.target.value)
            }
          />
          <InputError
            className='mt-2'
            message={errors.current_password}
          />
        </div>
        <div>
          <InputLabel
            htmlFor='password'
            value='New Password' />
          <TextInput
            autoComplete='new-password'
            className='mt-1 block w-full'
            id='password'
            ref={passwordInput}
            type='password'
            value={data.password}
            onChange={(e) => setData('password', e.target.value)}
          />
          <InputError
            className='mt-2'
            message={errors.password} />
        </div>
        <div>
          <InputLabel
            htmlFor='password_confirmation'
            value='Confirm Password'
          />
          <TextInput
            autoComplete='new-password'
            className='mt-1 block w-full'
            id='password_confirmation'
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
        <div className='flex items-center gap-4'>
          <PrimaryButton disabled={processing}>Save</PrimaryButton>
          <Transition
            enter='transition ease-in-out'
            enterFrom='opacity-0'
            leave='transition ease-in-out'
            leaveTo='opacity-0'
            show={recentlySuccessful}
          >
            <p className='text-sm text-gray-600'>
              Saved.
            </p>
          </Transition>
        </div>
      </form>
    </section>
  );
}
